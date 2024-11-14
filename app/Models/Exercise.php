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
    public Status | null $status;
    private string $table = 'exercises';
    private array $columns = ['id', 'name', 'status_id'];
    //Status update order
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

    public function create(string $name): int
    {
        $status = Status::getStatusByTitle($this->orderStatus[0]);

        $values = ['name' => $name, 'status_id' => $status->id];

        $response = $this->db->insert($this->table, $values);

        $this->id = is_string($response) ? $response : null;

        return $this->id ?? false;
    }

    public function getExercises(int $exerciseId = null): Exercise | array
    {
        if ($exerciseId !== null) {
            $filter = [[
                'id',
                '=',
                $exerciseId
            ]];

            $result = $this->db->select($this->table, $this->columns, $filter)[0] ?? null;

            //Raise error exercise id has no match
            if ($result == null) {
                throw new Exception('Exercise not found');
            }

            return new Exercise($result['id'], $result['name'], $result['status_id']);
        }

        $exercises = $this->db->select($this->table, $this->columns);

        $list = [];
        foreach ($exercises as $exercise) {
            $list[] = new Exercise($exercise['id'], $exercise['name'], $exercise['status_id']);
        }

        return $list;
    }

    public function alterStatus(int $idExercise): bool
    {
        $exercise = $this->getExercises($idExercise);

        //Get authorized status
        $authorizedOrderStatus = $this->orderStatus;
        array_pop($authorizedOrderStatus);

        //Throw error if there isn't a next step for the current status
        if (!in_array($exercise->status->title, $authorizedOrderStatus)) {
            throw new Exception("Status is not supported for alteration.");
        }

        //Get the next status following the order of title in $orderStatus
        $statusNextTitle = $this->orderStatus[array_search($exercise->status->title, $this->orderStatus) + 1];

        $statusNext = Status::getStatusByTitle($statusNextTitle);

        //Check that exercise has at least one field before allowing status change (Building -> Answering)
        if ($statusNext->title == $this->orderStatus[1]) {
            //Raise error no matching entry (FK) in fields for chosen exercise
            if (!$exercise->fields) {
                throw new Exception("Status change is not allowed");
            }
        }

        //Fetch exercise based on given id
        $valuesUpdate = ['status_id' => $statusNext->id];
        $filterExercise = [['id', '=', $idExercise]];

        $response = $this->db->update($this->table, $valuesUpdate, $filterExercise);

        return $response;
    }

    public function delete(int $idExercise): bool
    {
        $exercise = $this->getExercises($idExercise);

        //Throw error if there isn't a next step for the current status
        if ($exercise->status->title != end($this->orderStatus)) {
            throw new Exception("Status is not supported for deletion.");
        }

        //Fetch exercise based on given id
        $filterExercise = [['id', '=', $idExercise]];

        $response = $this->db->delete($this->table, $filterExercise);

        return $response;
    }

    private function setValues(array $values): void
    {
        $this->id = isset($values['id']) && $values['id'] != null ? $values['id'] : null;
        $this->name = isset($values['name']) && $values['name'] != null ? $values['name'] : null;
        $this->statusId = isset($values['status_id']) && $values['status_id'] != null ? $values['status_id'] : null;
        $this->fields = $this->id != null ? (new Field())->getFields($this->id) : null;
        $this->status = $this->id != null ? (new Status())->getStatus($this->statusId) : null;
    }
}