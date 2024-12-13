<?php

namespace App\Models;

use App\Core\Model;
use http\Exception;

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
        }

        return $answer;
    }

    public static function table(): ?string
    {
        return 'fulfillments_answer_fields';
    }
}
