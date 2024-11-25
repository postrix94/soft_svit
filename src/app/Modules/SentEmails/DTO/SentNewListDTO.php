<?php

namespace App\Modules\SentEmails\DTO;

class SentNewListDTO
{
    private const LENTH_IP_ADRESS = 255;
    private const LENTH_USER_AGENT = 255;

    readonly string $uuid;
    readonly string $from;
    readonly string $to;
    readonly string|null $cc;
    readonly string $subject;
    readonly string $type;
    readonly string $body;
    readonly string $ip;
    readonly string $userAgent;

    /**
     * @param string $uuid
     * @param string $from
     * @param string $to
     * @param string|null $cc
     * @param string $subject
     * @param string $type
     * @param string $body
     * @param string $ip
     * @param string $userAgent
     */
    public function __construct(string $uuid, string $from, string $to, string $subject, string $type, string $body, string $ip, string $userAgent, ?string $cc = null)
    {
        $this->uuid = $uuid;
        $this->from = $from;
        $this->to = $to;
        $this->cc = $cc;
        $this->subject = $subject;
        $this->type = $type;
        $this->body = $body;
        $this->ip = $ip;
        $this->userAgent = $userAgent;
    }

    /**
     * @param string $ip
     * @return string
     */
    private function checkLengthIPAdress(string $ip): string {
       return strlen($ip) < self::LENTH_IP_ADRESS ? $ip : substr($ip, self::LENTH_IP_ADRESS);
    }

    /**
     * @param string $userAgent
     * @return string
     */
    private function checkLengthUserAgent(string $userAgent):string {
        return strlen($userAgent) < self::LENTH_USER_AGENT ? $userAgent : substr($userAgent, self::LENTH_USER_AGENT);
    }
}
