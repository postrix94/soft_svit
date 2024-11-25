<?php

namespace App\Services\RabbitMQ;

use App\Mail\TestListMail;
use Exception;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;


final class RabbitMQ
{
    /**
     * @param string $message
     */
    public static function sendEmail(string $message): void
    {
        try {
            $connection = new AMQPStreamConnection(
                Config::get('rabbitmq.host'),
                Config::get('rabbitmq.port'),
                Config::get('rabbitmq.user'),
                Config::get('rabbitmq.password'),
            );
            $channel = $connection->channel();

            // с параметром durable установленным в true. Очередь не будет удалятся при перезагрузке сервера.
            $channel->queue_declare(
                queue: Config::get('rabbitmq.queries.email.name'),
                durable: true,
                auto_delete: false,
            );

            $channel->exchange_declare(
                exchange: Config::get('rabbitmq.exchange.soft_svit.name'),
                type: Config::get('rabbitmq.exchange.soft_svit.type'),
                passive: false,
                durable: true,
                auto_delete: false
            );

            $channel->queue_bind(
                queue: Config::get('rabbitmq.queries.email.name'),
                exchange: Config::get('rabbitmq.exchange.soft_svit.name'),
                routing_key: Config::get('rabbitmq.exchange.soft_svit.routing_key')
            );

            //  Сохраняет сообщения при перезагрузке сервера delivery_mode === 2
            $msg = new AMQPMessage($message, ['delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT]);
            $channel->basic_publish(
                $msg,
                Config::get('rabbitmq.exchange.soft_svit.name'),
                Config::get('rabbitmq.exchange.soft_svit.routing_key')
            );


            $channel->close();
            $connection->close();
        } catch (Exception $e) {
            Log::error($e->getMessage() . "email: " . $message);
        }
    }

    public static function receiveEmail()
    {
        try {
            $connection = new AMQPStreamConnection(
                Config::get('rabbitmq.host'),
                Config::get('rabbitmq.port'),
                Config::get('rabbitmq.user'),
                Config::get('rabbitmq.password'),
            );

            $channel = $connection->channel();
            $channel->basic_qos(0, Config::get("queries.email.prefetch_count"), false);

            $callback = function ($msg) use ($channel) {
                try {
                    $email = json_decode($msg->body, true);
                    $mailer = new TestListMail($email);
                    Mail::to($email["to"])->send($mailer);

                    $channel->basic_ack($msg->delivery_info['delivery_tag']);
                } catch (Exception $e) {
                    Log::error($e->getMessage());
                }
            };

            $channel->basic_consume(
                Config::get("rabbitmq.queries.email.name"),
                '',
                false,
                Config::get("rabbitmq.queries.email.no_ack"),
                false,
                Config::get("rabbitmq.queries.email.nowait"),
                $callback);

            $channel->consume();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }
}
