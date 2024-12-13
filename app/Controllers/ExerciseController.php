<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Answer;
use App\Models\Exercise;
use App\Models\Field;
use App\Models\Fulfillment;
use App\Models\Test;

class ExerciseController extends Controller
{
    public function takeAnExercise()
    {
        $exercises = Exercise::getAll();

        if (is_bool($exercises)) {
            $exercises = [];
        }

        require __DIR__ . "/../Views/takeAnExercise.php";
    }

    public function answerExercisePage(int $exerciseId)
    {
        $filter = [['id', '=', $exerciseId]];
        $exercise = Exercise::get($filter);

        if ($exercise->status->id != 2) {
            header("Location: /");
            return;
        }

        $filter = [['exercise_id', '=', $exercise->id]];
        $fields = Field::get($filter);

        require __DIR__ . "/../Views/answerExercise.php";
    }

    public function answer(int $exerciseId)
    {
        $timestamp = (new \DateTime('now'))->format('Y-m-d H:i:s');
        $values = [
            'timestamp_test' => $timestamp,
            'exercise_id' => $exerciseId,
        ];
        $fulfillment = Fulfillment::insert($values);

        foreach ($_POST['field'] as $fieldId => $value) {
            $values = [
                'answer' => $value,
                'fulfillment_id' => (int)$fulfillment,
                'field_id' => $fieldId
            ];
            $answer = Answer::insert($values);
        }

        header('Location: /exercises/' . $exerciseId . '/fulfillments/' . (int)$fulfillment . '/edit');
    }

    public function editAnswerPage(int $exerciseId, int $fulfillmentId)
    {
        $filter = [['id', '=', $exerciseId]];
        $exercise = Exercise::get($filter);

        if ($exercise->status->id != 2) {
            header("Location: /");
            return;
        }

        $filter = [['exercise_id', '=', $exerciseId]];
        $fields = Field::get($filter);

        $filter = [['fulfillment_id', '=', $fulfillmentId]];
        $answers = Answer::get($filter);

        $fields_ids = array_map(
            function ($field) {
                return $field->id;
            },
            $fields
        );

        $answers = array_combine($fields_ids, $answers);

        require __DIR__ . "/../Views/editAnswer.php";
    }

    public function editAnswer(int $exerciseId, int $fulfillmentId)
    {
        foreach ($_POST['field'] as $fieldId => $value) {
            $values = [
                'answer' => $value
            ];
            $filters = [
                ['field_id', '=', $fieldId],
                ['fulfillment_id', '=', $fulfillmentId]
            ];

            Answer::update($values, $filters);
        }

        header('Location: /exercises/' . $exerciseId . '/fulfillments/' . $fulfillmentId . '/edit');
    }

    public function exerciseCreation()
    {
        $name = $_POST['exercise']['name'];

        //Block if $name is null or an empty string
        if (!isset($name) || $name == '') {
            header('Location: /exercises/new');

            return;
        }

        $values = ["name" => $name];
        $response = Exercise::insert($values);

        if (!$response) {
            header('Location: /exercises/new');

            return;
        }

        header('Location: /exercises/' . $response . '/fields');
    }

    public function exerciseDelete($exerciseId)
    {
        //Block if $name is null or an empty string
        if (!isset($exerciseId) || !ctype_digit($exerciseId)) {
            header('Location: /exercises');

            return;
        }

        //ToDo make an 404 error page
        $filter = [['id', '=', $exerciseId]];
        Exercise::delete($filter);

        header('Location: /exercises');
    }

    public function editExercisePage($exerciseId)
    {
        $filter = [['id', '=', $exerciseId]];
        $exercise = Exercise::get($filter);

        if ($exercise->status->id != 1) {
            header('Location: /');
            return;
        }

        $filter = [['exercise_id', '=', $exerciseId]];
        $fields = Field::get($filter);

        if (is_bool($fields)) {
            $fields = [];
        }

        require __DIR__ . '/../Views/editFields.php';
    }

    public function deleteField($exerciseId, $fieldId)
    {
        $filter = [['id', '=', $exerciseId]];
        $exercise = Exercise::get($filter);

        if ($exercise->status->id != 1) {
            header('Location: /');
            return;
        }

        $filter = [['id', '=', $fieldId]];
        $delete = Field::delete($filter);

        header('Location: /exercises/' . $exerciseId . '/fields');
    }

    public function addField($exerciseId)
    {
        $filter = [['id', '=', $exerciseId]];
        $exercise = Exercise::get($filter);

        if ($exercise->status->id != 1) {
            header('Location: /');
            return;
        }

        if (!isset($_POST['field']['label']) || !isset($_POST['field']['value_kind'])) {
            header('Location: /exercises/' . $exerciseId . '/fields');
        }

        $values = [
            'name' => $_POST['field']['label'],
            'type_id' => $_POST['field']['value_kind'],
            'exercise_id' => $exerciseId
        ];

        Field::insert($values);

        header('Location: /exercises/' . $exerciseId . '/fields');
    }

    public function editFieldPage($exerciseId, $fieldId)
    {
        $filter = [['id', '=', $exerciseId]];
        $exercise = Exercise::get($filter);

        if ($exercise->status->id != 1) {
            header('Location: /');
            return;
        }

        $filter = [['id', '=', $fieldId]];
        $field = (Field::get($filter))[0];

        require __DIR__ . "/../Views/editField.php";
    }

    public function editField($exerciseId, $fieldId)
    {
        $filter = [['id', '=', $exerciseId]];
        $exercise = Exercise::get($filter);

        if ($exercise->status->id != 1) {
            header('Location: /');
            return;
        }

        if (!isset($_POST['field']['label']) || !isset($_POST['field']['value_kind'])) {
            header('Location: /exercises/' . $exerciseId . '/fields');
        }

        $values = [
            'name' => $_POST['field']['label'],
            'type_id' => $_POST['field']['value_kind']
        ];
        $filter = [['id', '=', $fieldId]];

        Field::update($values, $filter);

        header('Location: /exercises/' . $exerciseId . '/fields');
    }

    public function exercisesPage()
    {
        $exercises = Exercise::getAll();

        if (is_bool($exercises)) {
            $exercises = [];
        }

        require __DIR__ . "/../Views/manageExercises.php";
    }

    public function exerciseStatusAlteration($exerciseId)
    {
        //Block if $name is null or isn't a string of a number
        if (!isset($exerciseId) || !ctype_digit($exerciseId)) {
            header('Location: /exercises');

            return;
        }

        $filter = [['id', '=', $exerciseId]];
        $exercise = Exercise::get($filter);

        if ($exercise->status->id == 1 || $exercise->status->id == 2) {
            $values = [
                'status_id' => $exercise->status->id + 1
            ];
            Exercise::update($values, $filter);
        }

        header('Location: /exercises');
    }
}
