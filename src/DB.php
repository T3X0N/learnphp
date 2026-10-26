<?php
namespace App;

use PDO;
use InvalidArgumentException;

class DB {
    private PDO $conn;

    public function __construct()
    {
        $this->conn = new PDO(
            'mysql:host=localhost:33061;dbname=learnphp;charset=utf8mb4',
            'root',
            'example',
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    }

    public function all(string $table, string $class): array {
        $statement = $this->conn->query('SELECT * FROM ' . $this->identifier($table));
        $statement->setFetchMode(PDO::FETCH_CLASS, $class);
        return $statement->fetchAll();
    }

    public function where(string $table, string $class, string $field, mixed $value): array {
        $statement = $this->conn->prepare(
            'SELECT * FROM ' . $this->identifier($table)
            . ' WHERE ' . $this->identifier($field) . ' = :value'
        );
        $statement->execute(['value' => $value]);
        $statement->setFetchMode(PDO::FETCH_CLASS, $class);
        return $statement->fetchAll();
    }

    public function find(string $table, string $class, int $id) {
        $statement = $this->conn->prepare(
            'SELECT * FROM ' . $this->identifier($table) . ' WHERE id = :id'
        );
        $statement->execute(['id' => $id]);
        $statement->setFetchMode(PDO::FETCH_CLASS, $class);
        return $statement->fetch() ?: null;
    }

    public function insert(string $table, array $fields): int {
        if (!$fields) {
            throw new InvalidArgumentException('Cannot insert an empty record.');
        }

        $columns = array_map([$this, 'identifier'], array_keys($fields));
        $placeholders = array_map(static fn($column) => ':' . $column, array_keys($fields));
        $statement = $this->conn->prepare(
            'INSERT INTO ' . $this->identifier($table)
            . ' (' . implode(', ', $columns) . ') VALUES ('
            . implode(', ', $placeholders) . ')'
        );
        $statement->execute($fields);
        return (int) $this->conn->lastInsertId();
    }

    public function update(string $table, array $fields, int $id): void {
        if (!$fields) {
            throw new InvalidArgumentException('Cannot update an empty record.');
        }

        $assignments = [];
        $values = [];
        foreach ($fields as $column => $value) {
            $column = $this->identifier($column);
            $parameter = 'field_' . count($assignments);
            $assignments[] = $column . ' = :' . $parameter;
            $values[$parameter] = $value;
        }

        $values['id'] = $id;
        $statement = $this->conn->prepare(
            'UPDATE ' . $this->identifier($table)
            . ' SET ' . implode(', ', $assignments) . ' WHERE id = :id'
        );
        $statement->execute($values);
    }

    public function delete(string $table, int $id): void {
        $statement = $this->conn->prepare(
            'DELETE FROM ' . $this->identifier($table) . ' WHERE id = :id'
        );
        $statement->execute(['id' => $id]);
    }

    private function identifier(string $name): string {
        if (!preg_match('/\A[a-zA-Z_][a-zA-Z0-9_]*\z/', $name)) {
            throw new InvalidArgumentException('Invalid database identifier.');
        }

        return '`' . $name . '`';
    }
}