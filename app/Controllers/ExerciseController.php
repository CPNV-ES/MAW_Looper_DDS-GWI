<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Exercise;

class ExerciseController extends Controller
{
    public function exerciseCreation()
    {
        $name = $_POST['exercise']['name'];

        if (!isset($name)) {
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