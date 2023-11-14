<?php

require_once './app/config.php';

class Model {

        protected $db;

        function __construct() {
            $this->createDatabaseIfNotExists();
            $this->db = new PDO('mysql:host='. MYSQL_HOST .';dbname='. MYSQL_DB .';charset=utf8', MYSQL_USER, MYSQL_PASS);
            $this->deploy();
        }

        private function createDatabaseIfNotExists(){
            $pdo = new PDO('mysql:host=' . MYSQL_HOST, MYSQL_USER, MYSQL_PASS);
            $query = 'CREATE DATABASE IF NOT EXISTS ' . MYSQL_DB;
            $pdo->exec($query);
        }

        function deploy() {
            $hashedPass = '$2y$10$aVxjlmeBxJez2mITsUD0ou5hHp4varCJc5ngKvCF6ptjPlhzxXmmK';
            $query = $this->db->query('SHOW TABLES');
            $tables = $query->fetchAll();
            if(count($tables)==0) {
                $sql =<<<END

                CREATE TABLE users (user_id int(11) NOT NULL,user_name varchar(50) NOT NULL, user_password varchar(255) NOT NULL); 
                
                INSERT INTO users (user_id, user_name, user_password) VALUES ('1','webadmin','$hashedPass');
                
                ALTER TABLE users
                    ADD PRIMARY KEY (user_id);
                
                ALTER TABLE users
                    MODIFY user_id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

                CREATE TABLE categories (category_id int(11) NOT NULL, category_name varchar(50) NOT NULL);
      
                INSERT INTO categories (category_id,category_name) VALUES ('1','Congelados'),('2','Barras de cereal'),('3','Frutos secos'),('4','Bebidas');
      
                ALTER TABLE categories
                    ADD PRIMARY KEY (category_id);
                      
                ALTER TABLE categories
                    MODIFY category_id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

                CREATE TABLE products (
                        product_id int(11) NOT NULL,
                        product_name varchar(50) NOT NULL,
                        product_stock int(11) NULL,
                        product_price double NOT NULL,
                        category_id int(11) NOT NULL
                      );
      
                INSERT INTO products (product_id, product_name,product_stock,product_price,category_id) VALUES ('1','Medallones de calabaza','20','590','1'),('2','Barra de cereal de chocolate','100','300','2'),('3','Nueces peladas x 100 grs','30','1500','3'), ('4','Kéfir de limón','20','1000','4');
      
                ALTER TABLE products
                    ADD PRIMARY KEY (product_id);
                      
                ALTER TABLE products
                    MODIFY product_id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
                      
                ALTER TABLE products
                    ADD CONSTRAINT fk_category_products FOREIGN KEY (category_id) REFERENCES categories(category_id);
                END;
                $this->db->query($sql);
            }
            
        }
    }
