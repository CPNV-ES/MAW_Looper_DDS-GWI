<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Answer;
use App\Models\Exercise;
use App\Models\Field;
use App\Models\Test;
use Cassandra\Date;

class ExerciseController extends Controller
{
    public function takeAnExercise()
    {
        $exercises = new Exercise();
        $exercises = $exercises->getExercises();

        (new Views())->takeAnExercise($exercises);
    }

    public function answerExercisePage(int $exerciseId)
    {
        $exercise = new Exercise();
        $exercise = $exercise->getExercises($exerciseId);

        if ($exercise->statusId < 2) {
            header("Location: /");
            return;
        }

        $fields = new Field();
        $fields = $fields->getFields($exerciseId);

        (new Views())->answerExercise($exercise, $fields);
    }

    public function answer(int $exerciseId)
    {
        $timestamp = new \DateTime('now');
        $test = new Test(null, $timestamp, $exerciseId);

        foreach ($_POST['field'] as $fieldId => $value) {
            if ($value != '') {
                $answer = new Answer(null, $value, $test->id, $fieldId);
            }
        }

        header('Location: /exercises/' . $exerciseId . '/fulfillments/' . $test->id . '/edit');
    }

    public function exerciseCreation()
    {
        $name = $_POST['exercise']['name'];

        # ToDo check if want to put empty string check here or in Model.
        //Block if $name is null or an empty string
        if (!isset($name) || $name == '') {
            header('Location: /exercises/new');

            return;
        }

        $exercise = new Exercise();

        $response = $exercise->create($name);

        if (!$response) {
            header('Location: /exercises/new');

            return;
        }

        header('Location: /exercises/' . $exercise->id . '/fields');
    }

    public function editExercise($exerciseId)
    {
        $exercise = (new Exercise())->getExercises($exerciseId);

        if ($exercise->statusId != 1) {
            header('Location: /');
            return;
        }

        (new Views())->editFields($exercise);
    }

    public function deleteField($exerciseId, $fieldId)
    {
        $exercise = (new Exercise())->getExercises($exerciseId);

        if ($exercise->statusId != 1) {
            header('Location: /');
            return;
        }

        $delete = (new Field())->deleteField($fieldId);

        header('Location: /exercises/' . $exerciseId . '/fields');
    }

    public function addField($exerciseId)
    {
        $exercise = (new Exercise())->getExercises($exerciseId);

        if ($exercise->statusId != 1) {
            header('Location: /');
            return;
        }

        if (!isset($_POST['field']['label']) || !isset($_POST['field']['value_kind'])) {
            header('Location: /exercises/' . $exerciseId . '/fields');
        }

        $name = $_POST['field']['label'];
        $typeId = $_POST['field']['value_kind'];

        (new Field())->createField($name, $typeId, $exerciseId);

        header('Location: /exercises/' . $exerciseId . '/fields');
    }

    public function editFieldPage($exerciseId, $fieldId)
    {
        $exercise = (new Exercise())->getExercise($exerciseId);

        if ($exercise->statusId != 1) {
            header('Location: /');
            return;
        }

        $field = (new Field())->getField($fieldId);

        (new Views())->editField($exercise, $field);
    }

    public function editField($exerciseId, $fieldId)
    {
        $exercise = (new Exercise())->getExercise($exerciseId);

        if ($exercise->statusId != 1) {
            header('Location: /');
            return;
        }

        if (!isset($_POST['field']['label']) || !isset($_POST['field']['value_kind'])) {
            header('Location: /exercises/' . $exerciseId . '/fields');
        }

        $name = $_POST['field']['label'];
        $typeId = $_POST['field']['value_kind'];

        $field = (new Field())->getField($fieldId);
        $field->updateField($name, $typeId, $exerciseId);

        header('Location: /exercises/' . $exerciseId . '/fields');
    }
}
