<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Exercise;

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
}