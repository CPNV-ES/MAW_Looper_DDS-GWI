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

        (new Views())->editFields($exercise);
    }

    public function deleteField($exerciseId, $fieldId)
    {
        $delete = (new Field())->deleteField($fieldId);

        header('Location: /exercises/' . $exerciseId . '/fields');
    }

    public function addField($exerciseId)
    {
        if (!isset($_POST['field']['label']) || !isset($_POST['field']['value_kind'])) {
            header('Location: /exercises/' . $exerciseId . '/fields');
        }

        $name = $_POST['field']['label'];
        $typeId = $_POST['field']['value_kind'];

        (new Field())->createField($name, $typeId, $exerciseId);

        header('Location: /exercises/' . $exerciseId . '/fields');
    }
}