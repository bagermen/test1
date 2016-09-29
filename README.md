# Album (test task)
**Installation**:

1. Back end installation
    1. `composer install`
    2. `app/console doctrine:schema:create`
    3. `app/console doctrine:fixtures:load`
2. Front end installation
    1. `npm install`
    2. `bower install`
    3. `grunt prod`
    4. `app/console assets:install web --symlink`
3. Run server with command: `app/console server:run`

Project will be available at **localhost:8000**

**Requirements**: PHP, MySQL, npm, compass

**SQL**:

    SELECT a.*
    FROM album a
    JOIN image i ON i.album_id = a.id
    GROUP BY a.id
    HAVING COUNT(i.id ) <= 10
