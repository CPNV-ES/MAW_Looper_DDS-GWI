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
    private array $orderStatus = ['Building', 'Answering', 'Closed'];

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

    public function alterStatus(int $idExercise): bool
    {
        $statusArray = Status::getStatus();

        //Fetch exercise based on given id
        $tableExercise = 'exercises';
        $valuesExercise = ['status_id', 'name'];
        $filterExercise = [['id', '=', $idExercise]];

        $responseExercise = $this->db->select($tableExercise, $valuesExercise, $filterExercise);

        //Raise error exercise id has no match
        if (!$responseExercise) {
            throw new Exception("Exercise not found");
        }

        $statusNextTitle = null;
        //Check if current status is managed and get the next step status title
        foreach ($statusArray as $status) {
            //Get current status of exercise
            if ($responseExercise[0]['status_id'] == $status['id']) {
                //Get the next status following the order of title in $orderStatus
                $statusNextTitle = $this->orderStatus[array_search($status['title'], $this->orderStatus) + 1];

                //Throw error if there isn't a next step for the current status
                if (is_null($statusNextTitle)) {
                    throw new Exception("Status is not supported for alteration.");
                }

                break;
            }
        }

        $statusNext = null;
        //Get the status corresponding to the next title
        foreach ($statusArray as $status) {
            if ($statusNextTitle == $status['title']) {
                $statusNext = $status;

                break;
            }
        }

        //Check that exercise has at least one field before allowing status change (Building -> Answering)
        if ($statusNext['title'] == 'Answering') {
            //Fetch fields based on given exercise id
            $tableField = 'fields';
            $valuesField = ['id'];
            $filterField = [['exercise_id', '=', $idExercise]];
            // One field is enough to allow the wanted status change
            $countField = 1;

            $responseField = $this->db->select($tableField, $valuesField, $filterField, $countField);

            //Raise error no matching entry (FK) in fields for chosen exercise
            if (!$responseField) {
                throw new Exception("Status change is not allowed");
            }
        }

        $valuesUpdate = ['status_id' => $statusNext['id']];
        $response = $this->db->update($tableExercise, $valuesUpdate, $filterExercise);

        return $response;
    }

    private function setValues(array $values): void
    {
        $this->id = isset($values['id']) && $values['id'] != null ? $values['id'] : null;
        $this->name = isset($values['name']) && $values['name'] != null ? $values['name'] : null;
        $this->statusId = isset($values['status_id']) && $values['status_id'] != null ? $values['status_id'] : null;
        $this->fields = $this->id != null ? (new Field())->getFields($this->id) : null;
    }
}