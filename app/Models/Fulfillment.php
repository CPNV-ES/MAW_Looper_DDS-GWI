<?php

namespace App\Models;

use App\Core\Model;
use DateTime;

class Fulfillment extends Model
{
    public int $id;
    public \DateTime $timestamp_test;
    public int | Exercise $exercise;

    public static function get(array $filter): Model|bool
    {
        $fulfillment = parent::get($filter);

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
