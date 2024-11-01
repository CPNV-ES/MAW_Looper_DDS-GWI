<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Exercise;
use App\Models\Field;
use SebastianBergmann\Type\VoidType;

class Views extends Controller
{
    public function home(): void
    {
        require __DIR__ . "/../Views/home.php";
    }

    public function takeAnExercise(): void
    {
        require __DIR__ . "/../Views/takeAnExercise.php";
    }

    public function createAnExercise(): void
    {
        require __DIR__ . "/../Views/createAnExercise.php";
    }

    public function manageExercises(array $exercises): void
    {
        require __DIR__ . "/../Views/manageExercises.php";
    }

    public function editFields(Exercise $exercise): void
    {
        require __DIR__ . "/../Views/editFields.php";
    }

    public function editField(Exercise $exercise, Field $field): void
    {
        require __DIR__ . "/../Views/editField.php";
    }
}
