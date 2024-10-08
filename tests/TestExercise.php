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

    public function testCanCreateExercise()
    {
        $name = 'Test Exercise';

        $response = $this->exercise->create($name);

        $this->assertTrue($response);
    }
}
