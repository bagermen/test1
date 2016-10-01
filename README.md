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
*List of all albums and images with MAX 10 images at an album*

    
    SET @album = 0;
    SET @n = 0;
    
    SELECT a.*, i.*, @n := IF(@album <> a.id, 1, @n + 1) num, @album := a.id
    FROM album a
    JOIN image i ON i.album_id = a.id
    HAVING num <= 10
    ORDER BY a.id, i.id
