<?php

namespace App\Models;

use App\Core\Model;
use DateTime;

class Fulfillment extends Model
{
    public int $id;
    public string $timestamp_fulfillment;
    public int | Exercise $exercise;

    public static function get(array $filter): Model|bool|array
    {
        $fulfillment = parent::get($filter);

        if (is_bool($fulfillment)) {
            return false;
        }

        if (is_array($fulfillment)) {
            foreach ($fulfillment as $key => $item) {
                $filter = [['id', '=', $item->exercise]];
                $item->exercise = Exercise::get($filter);

                $fulfillment[$key] = $item;
            }

            return $fulfillment;
        }

        $filter = [['id', '=', $fulfillment->exercise]];
        $fulfillment->exercise = Exercise::get($filter);

        return $fulfillment;
    }

    public static function getAll(): array|bool
    {
        $fulfillments = parent::getAll();

        foreach ($fulfillments as $key => $fulfillment) {
            $filter = [['id', '=', $fulfillment->id]];
            $fulfillment->exercise = Exercise::get($filter);

            $fulfillments[$key] = $fulfillment;
        }

        return $fulfillments;
    }
}
