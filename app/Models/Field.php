<?php

namespace App\Models;

use App\Core\Model;

class Field extends Model
{
    public int $id;
    public string $name;
    public FieldType | int $type;
    public Exercise | int $exercise;

    public static function get(array $filter): Model|bool|array
    {
        $object = parent::get($filter);

        if (is_bool($object)) {
            return false;
        }

        if (is_array($object)) {
            foreach ($object as $key => $field) {
                $filter = [['id', '=', $field->type]];
                $field->type = FieldType::get($filter);
                $object[$key] = $field;
            }

            return $object;
        }

        $filter = [['id', '=', $object->type]];
        $object->type = FieldType::get($filter);
        return $object;
    }

    public static function getAll(): array|bool
    {
        $fields = parent::getAll();

        foreach ($fields as $key => $field) {
            $filter = [['id', '=', $field->type]];
            $field->type = FieldType::get($filter);
            $fields[$key] = $field;
        }

        return $fields;
    }
}
