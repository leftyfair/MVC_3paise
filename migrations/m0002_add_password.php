<?php

use app\core\Application;

class m0002_add_password
{
    public function up()
    {
        Application::$app->db->pdo->exec("ALTER TABLE users ADD COLUMN password VARCHAR(512) NOT NULL");
    }
    public function down()
    {
        Application::$app->db->pdo->exec("ALTER TABLE users DROP COLUMN password");
    }
}
