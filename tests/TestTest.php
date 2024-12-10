<?php


use PHPUnit\Framework\TestCase;
use App\Models\Test;

class TestTest extends TestCase
{
    public function testCanCreateTest()
    {
        $now = new DateTime('now');
        $exercise_id = 1;

        $test = new Test(null, $now, $exercise_id);

        $this->assertIsObject($test);
        $this->assertEquals($now, $test->timestamp);
    }

    public function testCanGetTestViaConstructor()
    {
        $test = new Test(1);

        $this->assertIsObject($test);
        $this->assertNotNull($test->timestamp);
    }

    public function testCanGetTest()
    {
        $test = new Test();
        $test = $test->getTest(1);

        $this->assertIsObject($test);
        $this->assertNotNull($test->timestamp);
    }

    public function getTestsByExercise()
    {
        $tests = (new Test())->getTestsByExercise(1);

        $this->assertIsArray($tests);
        $this->assertContainsOnlyInstancesOf(Test::class, $tests);
    }
}
