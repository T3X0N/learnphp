<?php

namespace App\Models;

use App\DB;

abstract class Model
{
    public ?int $id = null;
    public static string $table;

    public static function all(): array
    {
        $db = new DB();
        return $db->all(static::$table, static::class);
    }

    public static function find(int $id): ?static
    {
        $db = new DB();
        return $db->find(static::$table, static::class, $id);
    }

    public function save(): void
    {
        $fields = get_object_vars($this);
        unset($fields['id'], $fields['created_at'], $fields['updated_at']);

        $db = new DB();
        if ($this->id !== null) {
            $db->update(static::$table, $fields, $this->id);
            return;
        }

        $this->id = $db->insert(static::$table, $fields);
    }

    public function delete(): void
    {
        if ($this->id === null) {
            throw new \LogicException('Cannot delete a record without an id.');
        }

        $db = new DB();
        $db->delete(static::$table, $this->id);
    }
}
