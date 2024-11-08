<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Answer;
use App\Models\Exercise;
use App\Models\Field;
use App\Models\Test;

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

        //ToDo direct != on futur status attribut (object of the corresponding status based on exercise statusId)
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
            $answer = new Answer(null, $value, $test->id, $fieldId);
        }

        header('Location: /exercises/' . $exerciseId . '/fulfillments/' . $test->id . '/edit');
    }

    public function editAnswerPage(int $exerciseId, int $testId)
    {
        $exercise = new Exercise();
        $exercise = $exercise->getExercises($exerciseId);

        if ($exercise->statusId < 2) {
            header("Location: /");
            return;
        }

        $fields = new Field();
        $fields = $fields->getFields($exerciseId);

        $answers = new Answer();
        $answers = $answers->getByTest($testId);

        (new Views())->editAnswer($exercise, $fields, $answers);
    }

    public function editAnswer(int $exerciseId, int $testId)
    {
        foreach ($_POST['field'] as $fieldId => $value) {
            $values = [
                'answer' => $value
            ];
            $filters = [
                ['field_id', '=', $fieldId],
                ['test_id', '=', $testId]
            ];

            $answer = new Answer();
            $answer->update($values, $filters);
        }

        header('Location: /exercises/' . $exerciseId . '/fulfillments/' . $testId . '/edit');
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

    public function editExercisePage($exerciseId)
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
        $exercise = (new Exercise())->getExercises($exerciseId);

        if ($exercise->statusId != 1) {
            header('Location: /');
            return;
        }

        $field = (new Field())->getField($fieldId);

        (new Views())->editField($exercise, $field);
    }

    public function editField($exerciseId, $fieldId)
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

        $field = (new Field())->getField($fieldId);
        $field->updateField($name, $typeId, $exerciseId);

        header('Location: /exercises/' . $exerciseId . '/fields');
    }

    public function exercisesPage()
    {
        $exercises = (new Exercise())->getExercises();

        (new Views())->manageExercises($exercises);
    }

    public function exerciseStatusAlteration($exerciseId)
    {
        //Block if $name is null or isn't a string of a number
        if (!isset($exerciseId) || !ctype_digit($exerciseId)) {
            header('Location: /exercises');

            return;
        }

        //ToDo deal with thrown Exception (need to to see standard to deal with this)
        (new Exercise())->alterStatus($exerciseId);

        header('Location: /exercises');
    }
}
