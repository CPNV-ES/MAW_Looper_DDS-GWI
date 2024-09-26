<?php

namespace App\Controllers;

use App\Core\Controller;
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

    public function manageExercises(): void
    {
        require __DIR__ . "/../Views/manageExercises.php";
    }

    public function editFields($exerciseId): void
    {
        require __DIR__ . "/../Views/editFields.php";
    }
}
