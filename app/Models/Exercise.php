<?php

namespace App\Models;

use App\Core\Model;
use Exception;

class Exercise extends Model
{
    private $orderStatus = ['Building', 'Answering', 'Closed'];

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
                    throw new Exception("Status is not supported.");
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
}