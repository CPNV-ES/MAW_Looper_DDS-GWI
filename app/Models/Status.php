<?php

namespace App\Models;

use App\Core\Model;

use Exception;

class Status extends Model
{
    public int | null $id;
    public string | null $title;
    private static array $status = [];

    public function __construct(int $id = null, string $title = null)
    {
        parent::__construct();

        $this->id = $id;
        $this->title = $title;
    }

    //Setup should only be called once to avoid useless db requests
    private function setUp(): void
    {
        $table = 'status';
        $values = ['id', 'title'];

        $responseStatus = $this->db->select($table, $values);

        //Raise error exercise if no status. This should only happen if db table is empty
        if (!$responseStatus) {
            throw new Exception("Not any Status found");
        }

        //Loop over all db status entry and make an object of it
        foreach ($responseStatus as $statusInstance) {
            $status = new Status($statusInstance['id'], $statusInstance['title']);

            self::$status[] = $status;
        }
    }

    public static function getStatus(int $statusId = null): Status | array
    {
        //Status shouldn't change so we limit db data fetching
        if (!self::$status) {
            (new Status)->setUp();
        }

        //Will return null if no match for a given $statusId
        $status = null;

        if (is_null($statusId)) {
            $status = self::$status;
        } else {
            foreach (self::$status as $statusInstance) {
                print_r($statusInstance);
                if ($statusInstance->id == $statusId) {
                    $status = $statusInstance;

                    break;
                }
            }
        }

        if ($status == null) {
            throw new Exception('Status not found');
        }

        return $status;
    }

    public static function getStatusByTitle(string $title): Status
    {
        //Status shouldn't change so we limit db data fetching
        if (!self::$status) {
            (new Status)->setUp();
        }

        $status = null;

        foreach (self::$status as $statusInstance) {
            if ($statusInstance->title == $title) {
                $status = $statusInstance;

                break;
            }
        }

        if ($status == null) {
            throw new Exception('Status not found');
        }

        return $status;
    }
}