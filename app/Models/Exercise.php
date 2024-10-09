<?php

namespace App\Models;

use App\Core\Model;
use Exception;

class Exercise extends Model
{
    public $id = null;

    public function create(string $name): bool
    {
        //ToDo see where to put this in code exactly (fk id fetch part)
        $tableFK = 'status';
        $valuesFK = ['id'];
        // Building is base status of exercise
        $filterFK = [['title', '=', 'Building']];

        $responseFK = $this->db->select($tableFK, $valuesFK, $filterFK);

        //Raise error if base status is missing
        if (!$responseFK) {
            throw new Exception("Base exercise status not found");
        }

        $table = 'exercises';
        $values = ['name' => $name, 'status_id' => $responseFK[0]['id']];

        $response = $this->db->insert($table, $values);

        $this->id = is_string($response) ? $response : null;

        return $this->id ?? false;
    }
}