<?php

namespace app\core;

use PDO;

class Database
{
    public PDO $pdo;


    public function __construct(array $dbConfig)
    {
        $dsn = $dbConfig['dsn'];
        $username = $dbConfig['user'];
        $password = $dbConfig['password'];
        $this->pdo = new PDO($dsn, $username, $password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function applyMigrations()
    {
        # 마이그레이션 데이터를 보관하는 테이블 생성
        $this->createMigrationTable();

        # 마이그레이션 테이블 조회
        $appliedMigration = $this->getAppliedMigrations();

        $files = scandir(Application::$ROOT_DIR . '/migrations');

        $toApplyMigrations = array_diff($files, $appliedMigration, ['.', '..']); // ['.', '..'] 넣음으로써 if 제외가능

        $newMigrations = [];

        foreach ($toApplyMigrations as $migration) {
            // if ($migration == '.' || $migration == '..') continue;

            require_once Application::$ROOT_DIR . '/migrations/' . $migration;
            $className = pathinfo($migration, PATHINFO_FILENAME);
            $instance = new $className();
            $instance->up();
            $this->log("Applyied migration $migration");
            $newMigrations[] = $migration;
        }
        if (!empty($migration)) {
            $this->log("적용된 마이그레이션 데이터베이스에 저장함");
            $this->saveMigrations($newMigrations);
        } else {
            $this->log("이미 모든 마이그레이션이 적용돼있음");
        }
    }

    public function createMigrationTable()
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations(
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255),
            create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP)");
    }

    public function getAppliedMigrations()
    {
        $stmt = $this->pdo->prepare("SELECT migration FROM migrations");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function saveMigrations(array $migrations)
    {
        $migrations = array_map(fn ($m) => "('$m')", $migrations);
        $data = implode(",", $migrations);
        $stmt = $this->pdo->prepare("INSERT INTO migrations(migration) VALUES $data");
        $stmt->execute();
    }
    public function log(string $message)
    {
        echo '[ ' . date('Y-m-d H:i:s') . ' ] - ' . $message . PHP_EOL;
    }
}
