<?php

namespace App\Core;

use App\Core\Controller;
use App\Models\Exercise;

class ExerciseController extends Controller
{
    public function exerciseStatusAlteration()
    {
        $idExercise = $_POST['exercise']['id'];
        
        //Block if $name is null or an empty string
        if (!isset($idExercise) || ctype_digit($idExercise)) {
            header('Location: /exercises');

            return;
        }

        $exercise = new Exercise();

        //ToDo deal with Exception (need to to see standard to deal with this)
        $response = $exercise->alterStatus($idExercise);

        header('Location: /exercises');
    }
}
