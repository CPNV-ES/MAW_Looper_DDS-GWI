<?php

namespace App\Models;

use App\Core\Model;

use Exception;

class Status extends Model
{
    private $database;
    private static $status = [];

    //Setup should only be called once to avoid useless db requests
    private function setUp(): void
    {
        $this->database = new Database();

        $table = 'status';
        $values = ['id', 'title'];

        $responseStatus = $this->database->select($table, $values);

        //Raise error exercise if no status
        if (!$responseStatus) {
            throw new Exception("Exercise not found");
        }

        self::$status = $responseStatus;
    }

    public static function getStatus(): array
    {
        if (!self::$status) {
            (new Status)->setUp();
        }

        return self::$status;
    }
}