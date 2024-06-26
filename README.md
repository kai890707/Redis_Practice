
# Redis_Practice

# 架構說明

此架構為Fork [Nginx PHP MySQL](https://github.com/nanoninja/docker-nginx-php-mysql) 之儲存庫

此架構基於 `docker-compose` 建立，內部包含Nginx、PHP、MySQL、Redis等容器提供使用

PHP的撰寫基於 `symfony` 建構

架構稍微進行了修改，修改如下:
* 於 `docker-compose.yml` 中添加了Redis container
* 新增 `web\app\composer.json.dist` 中對於PRedis的套件引用
* 新增對於Redis操作的基礎設定(.env)

# 啟用

1. 複製composer的靜態設定檔，並更改為json檔
```bash
cp web/app/composer.json.dist web/app/composer.json
```

2. 利用Docker啟動
```bash
docker-compose up -d
```

3. 使用瀏覽器開啟
    * [http://localhost:8000](http://localhost:8000/)
    * [https://localhost:3000](https://localhost:3000/) ([HTTPS](#configure-nginx-with-ssl-certificates) 預設未開啟HTTPS，若需開啟則請參考[此處](https://github.com/nanoninja/docker-nginx-php-mysql?tab=readme-ov-file#configure-nginx-with-ssl-certificates))
    * [http://localhost:8080](http://localhost:8080/) PHPMyAdmin (username: dev, password: dev)

# 安裝predis擴展
若架構中未含predis擴展，請進行以下操作

```bash
docker run --rm -v ${PWD}/web/app:/app composer require predis/predis
```

# 應用 MySQL PDO連線方式
```php
<?php
    try {
        $dsn = 'mysql:host=mysql;dbname=test;charset=utf8;port=3306';
        $pdo = new PDO($dsn, 'dev', 'dev');
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
?>
```
