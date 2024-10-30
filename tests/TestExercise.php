<?php


use App\Models\Exercise;
use PHPUnit\Framework\TestCase;

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

    public function testCanGetExecise()
    {
        $exercise = (new Exercise())->getExercise(1);

        $this->assertequals(Exercise::class, get_class($exercise));
        $this->assertEquals(1, $exercise->id);
    }
}
