# Тестовое задание для Олега Каминского
Установка:

1. настроить базу в app/config/parameters.yml
2. выполнить `composer install`
3. выполнить `app/console doctrine:schema:create`
4. выполнить `app/console doctrine:fixtures:load`
5. выполнить `app/console assets:install web`
6. запустить сервер `app/console server:run` (проект будет в localhost:8000)

PS: Очень много времени заняла Marionettejs, т.к. с нею раньше не сталкивался и сделал насколько смог осилить её апи в течении 3х дней после работы. Работа с симфони проблем не создала. PHP код затачивался под 5.3 версию.
