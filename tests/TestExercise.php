<?php


use App\Models\Exercise;
use PHPUnit\Framework\TestCase;

class TestExercise extends TestCase
{

    public function testCanGetExecise()
    {
        $exercise = (new Exercise())->getExercise(1);

        $this->assertequals(Exercise::class, get_class($exercise));
        $this->assertEquals(1, $exercise->id);
    }
}
