<?php

namespace App\Core;

use App\Models\Database;

class Model
{
    public static Database $db;

    public function __construct(array $values = [])
    {
        if (!empty($values)) {
            $this->setValues($values);
        }
    }

    /**
     * @param array $filter
     * [ ["COLUMN", "SQL_OPERATOR", "VALUE"], [...] ]; For each array in the array, AND applied in SQL side.
     * @return object|bool
     */
    public static function get(array $filter): Model | bool | array
    {
        if (empty($filter)) {
            return false;
        }

        $class = get_called_class();

        $table = $class::table() != null ? $class::table() : str_replace("app\models\\", "", strtolower($class));
        $table = str_ends_with($table, "s") ? $table : $table . "s";

        $value = self::$db->select($table, ['*'], $filter);

        if (count($value) == 1) {
            return new $class($value[0]);
        }

        if (count($value) > 1) {
            $objects = [];
            foreach ($value as $item) {
                $objects[] = new $class($item);
            }

            return $objects;
        }

        return false;
    }

    public static function getAll(): array | bool
    {
        $class = get_called_class();

        $table = $class::table() != null ? $class::table() : str_replace("app\models\\", "", strtolower($class));
        $table = str_ends_with($table, "s") ? $table : $table . "s";

        $value = self::$db->select($table, ['*']);

        if (count($value) == 0) {
            return false;
        }

        $objects = [];
        foreach ($value as $item) {
            $objects[] = new $class($item);
        }

        return $objects;
    }

    public static function insert(array $values): string | bool
    {
        $class = get_called_class();

        $table = $class::table() != null ? $class::table() : str_replace("app\models\\", "", strtolower($class));
        $table = str_ends_with($table, "s") ? $table : $table . "s";

        $id = self::$db->insert($table, $values);

        if (is_string($id)) {
            return $id;
        }

        return false;
    }

    /**
     * @param array $values
     * @param array $filters
     * [ ["COLUMN", "SQL_OPERATOR", "VALUE"], [...] ]; For each array in the array, AND applied in SQL side.
     * @return bool
     */
    public static function update(array $values, array $filters): bool
    {
        $class = get_called_class();

        $table = $class::table() != null ? $class::table() : str_replace("app\models\\", "", strtolower($class));
        $table = str_ends_with($table, "s") ? $table : $table . "s";

        return self::$db->update($table, $values, $filters);
    }

    /**
     * @param array $filters
     * [ ["COLUMN", "SQL_OPERATOR", "VALUE"], [...] ]; For each array in the array, AND applied in SQL side.
     * @return bool
     */
    public static function delete(array $filters): bool
    {
        $class = get_called_class();

        $table = $class::table() != null ? $class::table() : str_replace("app\models\\", "", strtolower($class));
        $table = str_ends_with($table, "s") ? $table : $table . "s";

        return self::$db->delete($table, $filters);
    }

    public static function table(): string | null
    {
        return null;
    }

    private function setValues(array $values): void
    {
        foreach ($values as $key => $value) {
            if (preg_match('/\\w_id/', $key)) {
                $values[str_replace("_id", "", $key)] = $value;
                unset($values[$key]);
                $key = str_replace("_id", "", $key);
            }

            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}
