<?php
declare(strict_types=1);

namespace MeasurementService\App\DB;

use PDO;

class Database
{
    private PDO $conn;
    private static Database|null $instance = null;
    private function __construct()
    {
        $this->conn = new PDO('pgsql:host=measurement-service-postgres-1;port=5432;dbname=measurement;', 'postgres', 'postgres', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    }
    public static function getInstance(): self
    {
        if (null === self::$instance)
        {
            self::$instance = new self();
        }
        return self::$instance;
    }
    public function select(string $sql, array $data): array
    {
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function insert(string $sql, array $data): void
    {
        $this->conn->prepare($sql)->execute($data);
    }
    public function update(string $sql, array $data): void
    {
        $this->conn->prepare($sql)->execute($data);
    }
    public function rawUpdateWithReturnValue(string $sql): mixed
    {
        return$this->conn->query($sql)->fetch();
    }
}