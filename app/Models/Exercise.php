<?php

namespace App\Models;

use App\Core\Model;
use Exception;

class Exercise extends Model
{
    public int $id;
    public string $name;
    public Status | int $status;
    public int $count_fields;

    public static function get(array $filter): Model|bool
    {
        $exercise = parent::get($filter);

        $filter = [['id', '=', $exercise->status]];
        $exercise->status = Status::get($filter);

        $filter = [['exercise_id', '=', $exercise->id]];
        $exercise->count_fields = Field::get($filter) ? count((Field::get($filter))) : 0;

        return $exercise;
    }

    public static function getAll(): array|bool
    {
        $exercises = parent::getAll();

        if (empty($exercises)) {
            return false;
        }

        foreach ($exercises as $key => $exercise) {
            $filter = [['id', '=', $exercise->status]];
            $exercise->status = Status::get($filter);

            $filter = [['exercise_id', '=', $exercise->id]];
            $exercise->count_fields = Field::get($filter) ? count((Field::get($filter))) : 0;

            $exercises[$key] = $exercise;
        }

        return $exercises;
    }

    public static function insert(array $values): string|bool
    {
        $filter = [['title', '=', 'Building']];
        $values['status_id'] = (Status::get($filter))->id;

        return parent::insert($values);
    }

    public static function delete(array $filters): bool
    {
        $exercise = self::get($filters);

        if (is_bool(array_search($exercise->status->title, ['Building', 'Closed']))) {
            return false;
        }

        return parent::delete($filters);
    }
}
