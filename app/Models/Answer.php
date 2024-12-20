<?php

namespace App\Models;

use App\Core\Model;

class Answer extends Model
{
    public int $id;
    public string $answer;
    public Fulfillment | int $fulfillment;
    public Field | int $field;

    public static function get(array $filter): Model|bool|array
    {
        $answer = parent::get($filter);

        if (is_array($answer)) {
            foreach ($answer as $key => $value) {
                $filter = [['id', '=', $value->fulfillment]];
                $value->fulfillment = Fulfillment::get($filter);

                $filter = [['id', '=', $value->field]];
                $value->field = Field::get($filter);

                $answer[$key] = $value;
            }

            return $answer;
        }

        $filter = [['id', '=', $answer->fulfillment]];
        $answer->fulfillment = Fulfillment::get($filter);

        $filter = [['id', '=', $answer->field]];
        $answer->field = Field::get($filter);
        return $answer;
    }

    public static function table(): ?string
    {
        return 'fulfillments_answer_fields';
    }
}
