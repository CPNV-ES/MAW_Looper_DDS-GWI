<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Exercise;
use App\Models\Field;
use Couchbase\View;

class ExerciseController extends Controller
{
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
        $exercise = (new Exercise())->getExercise($exerciseId);

        if ($exercise->statusId != 1) {
            header('Location: /');
            return;
        }

        (new Views())->editFields($exercise);
    }

    public function deleteField($exerciseId, $fieldId)
    {
        $exercise = (new Exercise())->getExercise($exerciseId);

        if ($exercise->statusId != 1) {
            header('Location: /');
            return;
        }

        $delete = (new Field())->deleteField($fieldId);

        header('Location: /exercises/' . $exerciseId . '/fields');
    }

    public function addField($exerciseId)
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

    public function exercisesPage()
    {
        $exercises = (new Exercise())->getExercises();

        (new Views())->manageExercises($exercises);
    }

    public function exerciseStatusAlteration()
    {
        $idExercise = $_POST['exercise']['id'];

        //Block if $name is null or isn't a string of a number
        if (!isset($idExercise) || ctype_digit($idExercise)) {
            header('Location: /exercises');

            return;
        }

        //ToDo deal with thrown Exception (need to to see standard to deal with this)
        (new Exercise())->alterStatus($idExercise);

        header('Location: /exercises');
    }
}