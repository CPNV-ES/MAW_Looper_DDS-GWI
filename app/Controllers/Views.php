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

    public function takeAnExercise(array $exercises): void
    {
        require __DIR__ . "/../Views/takeAnExercise.php";
    }

    public function answerExercise(Exercise $exercise, array $fields): void
    {
        require __DIR__ . "/../Views/answerExercise.php";
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

    public function editAnswer(Exercise $exercise, array $fields, array $answers = null): void
    {
        require __DIR__ . "/../Views/editAnswer.php";
    }

    public function showAnswerExercise(Exercise $exercise, array $fields, array $answers): void
    {
        require __DIR__ . "/../Views/showAnswerExercise.php";
    }

    public function showAllAnswerExercise(Exercise $exercise, array $fields, array $tests, array $tableAnswers): void
    {
        require __DIR__ . "/../Views/showAllAnswerExercise.php";
    }

    public function showAnswerField(Exercise $exercise, Field $field, array $tests, array $tableAnswers): void
    {
        require __DIR__ . "/../Views/showAnswerField.php";
    }
}
