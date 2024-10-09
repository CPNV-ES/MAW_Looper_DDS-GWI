<?php

use PHPUnit\Framework\TestCase;
use App\Models\Exercise;

class TestExercise extends TestCase
{
    private $exercise;

    public function setUp(): void
    {
        $this->exercise = new Exercise();
    }

    public function testCanAlterExerciseStatus()
    {
        //ToDo use exercise->creation

        $response = $this->exercise->alterStatus(500);

        $this->assertTrue($response);
    }
}
