<?php

namespace App\Models;

use App\Core\Model;
use Exception;

class Exercise extends Model
{
    public int | null $id;
    public string | null $name;
    public int | null $statusId;
    public array | null $fields;
    private string $table = 'exercises';
    private array $columns = ['id', 'name', 'status_id'];

    public function __construct(int $id = null, string $name = null, int $statusId = null)
    {
        parent::__construct();

        $values = [
            'id' => $id,
            'name' => $name,
            'status_id' => $statusId,
        ];

        $this->setValues($values);
    }

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

    public function getExercise(int $exerciseId = null): Exercise
    {
        $filter = [[
            'id',
            '=',
            $exerciseId == null ? $this->id : $exerciseId
        ]];

        $result = $this->db->select($this->table, $this->columns, $filter);

        if (!isset($result[0])) {
            throw new \Exception('Exercise not found');
        }

        $id = $result[0]['id'];
        $name = $result[0]['name'];
        $status_id = $result[0]['status_id'];

        return new Exercise($id, $name, $status_id);
    }

    private function setValues(array $values): void
    {
        $this->id = isset($values['id']) && $values['id'] != null ? $values['id'] : null;
        $this->name = isset($values['name']) && $values['name'] != null ? $values['name'] : null;
        $this->statusId = isset($values['status_id']) && $values['status_id'] != null ? $values['status_id'] : null;
        $this->fields = $this->id != null ? (new Field())->getFields($this->id) : null;
    }
}