<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Exercise;
use App\Models\Field;
use Couchbase\View;

class ExerciseController extends Controller
{
    public function editExercise($exerciseId)
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
}
