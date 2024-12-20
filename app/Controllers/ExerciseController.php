<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Exercise;
use App\Models\Field;
use App\Models\Test;

class ExerciseController extends Controller
{
    public function show()
    {
        $exercises = Exercise::getAll();

        if (is_bool($exercises)) {
            $exercises = [];
        }

        require __DIR__ . "/../Views/exercise/show.php";
    }

    public function create()
    {
        require __DIR__ . "/../Views/exercise/create.php";
    }

    public function showManage()
    {
        $exercises = Exercise::getAll();

        if (is_bool($exercises)) {
            $exercises = [];
        }

        require __DIR__ . "/../Views/exercise/showManage.php";
    }

    public function publish()
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

    public function delete($exerciseId)
    {
        //Block if $name is null or an empty string
        if (!isset($exerciseId) || !ctype_digit($exerciseId)) {
            header('Location: /exercises');

            return;
        }

        $filter = [['id', '=', $exerciseId]];
        Exercise::delete($filter);

        header('Location: /exercises');
    }

    public function edit($exerciseId)
    {
        $filter = [['id', '=', $exerciseId]];
        $exercise = Exercise::get($filter);

        //Status id 1 is Building
        if ($exercise->status->id != 1) {
            header('Location: /');
            return;
        }

        $filter = [['exercise_id', '=', $exerciseId]];
        $fields = Field::get($filter);
        $fields = is_bool($fields) ? [] : $fields;
        $fields = is_array($fields) ? $fields : [$fields];

        require __DIR__ . '/../Views/exercise/edit.php';
    }

    public function update($exerciseId)
    {
        //Block if $name is null or isn't a string of a number
        if (!isset($exerciseId) || !ctype_digit($exerciseId)) {
            header('Location: /exercises');

            return;
        }

        $filter = [['id', '=', $exerciseId]];
        $exercise = Exercise::get($filter);

        //Status id 1 is Building. Status id 2 is Answering
        if ($exercise->status->id == 1 || $exercise->status->id == 2) {
            $values = [
                'status_id' => $exercise->status->id + 1
            ];
            Exercise::update($values, $filter);
        }

        header('Location: /exercises');
    }
}
