<?php

use app\core\Application;

class m0001_initial
{
    public function up()
    {

        Application::$app->db->pdo->exec("CREATE TABLE users(
            id INT AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(255) NOT NULL, 
            firstname VARCHAR(255) NOT NULL,
            lastanme VARCHAR(255) NOT NULL,
            status TINYINT NOT NULL,
            create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP)");
    }

    public function down()
    {
        Application::$app->db->pdo->exec("DROP TABLE users");
    }
}
