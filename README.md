Перед тем как развернуть проект в файле ./src/.env - пропишите подключение для настройки почты:
MAIL_PORT=
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=

Развернуть проект локально:
1. В корне проекта запустить команду: docker compose build

2. В корне проекта запустить команду: docker compose up -d

3. Выполнить комады:
- docker-compose exec -it php composer install
- docker-compose exec -it php php artisan migrate

4. Чтобы запусть RabbitMQ Consumer в корне проекта: docker exec -it backend php artisan email:receive

