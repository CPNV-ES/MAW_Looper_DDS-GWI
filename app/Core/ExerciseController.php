<?php

namespace App\Core;

use App\Core\Controller;
use App\Models\Exercise;

class ExerciseController extends Controller
{
    public function exerciseStatusAlteration()
    {
        $idExercise = $_POST['exercise']['id'];

        # ToDo check if want to put empty string check here or in Model.
        //Block if $name is null or an empty string
        if (!isset($idExercise) || ctype_digit($idExercise)) {
            header('Location: /exercises');

            return;
        }

        $exercise = new Exercise();

        $response = $exercise->alterStatus($idExercise);

        header('Location: /exercises');
    }
}
