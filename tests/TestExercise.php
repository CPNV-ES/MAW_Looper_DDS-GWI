<?php

use PHPUnit\Framework\TestCase;
use App\Models\Exercise;
use App\Models\Field;

class TestExercise extends TestCase
{
    private $exercise;
    private $field;

    //ToDo see if better to make all setups by using SQL directly in DB (skipping class functions)
    public function setUp(): void
    {
        $this->exercise = new Exercise();
        $this->field = new Field();
    }

    public function testCanCreateExercise()
    {
        $name = 'Test Exercise';

        $response = $this->exercise->create($name);

        $this->assertIsInt($response);
    }

    public function testCanGetExercises()
    {
        $exerciseName = 'Test Exercise Alter Status';
        $fieldName = 'Test Field Alter Status';

        $exerciseIdNoField = $this->exercise->create($exerciseName);
        $exerciseIdWithField = $this->exercise->create($exerciseName);
        $this->field->createField($fieldName, 1, $exerciseIdWithField);

        $exercises = $this->exercise->getExercises();

        $this->assertIsArray($exercises);
        $this->assertObjectHasProperty('numberFields', $exercises[0]);

        //ToDo make an check extracting numberField from the 2 created exercises to check if number match
    }

    public function testCanGetExercise()
    {
        $exercise = (new Exercise())->getExercise(1);

        $this->assertequals(Exercise::class, get_class($exercise));
        $this->assertEquals(1, $exercise->id);
    }

    public function testCantAlterBuilding()
    {
        $exerciseName = 'Test Exercise Alter Status';

        $id = $this->exercise->create($exerciseName);

        try {
            $this->exercise->alterStatus($id);

            //ToDo see how to cleanly do in this kinda case
            throw new Exception("Unwanted success");
        } catch (Exception $e) {
            $this->assertEquals($e->getMessage(), 'Status change is not allowed');
        }

    }

    public function testCanAlterBuilding()
    {
        $exerciseName = 'Test Exercise Alter Status';
        $fieldName = 'Test Field Alter Status';

        $id = $this->exercise->create($exerciseName);
        $this->field->createField($fieldName, 1, $id);

        $response = $this->exercise->alterStatus($id);

        $this->assertTrue($response);
    }

    public function testCanAlterAnswering()
    {
        $name = 'Test Exercise Alter Status';
        $fieldName = 'Test Field Alter Status';

        $id = $this->exercise->create($name);
        $this->field->createField($fieldName, 1, $id);

        $this->exercise->alterStatus($id);
        $response = $this->exercise->alterStatus($id);

        $this->assertTrue($response);
    }

    public function testCantAlterClosed()
    {
        $name = 'Test Exercise Alter Status';
        $fieldName = 'Test Field Alter Status';

        $id = $this->exercise->create($name);
        $this->field->createField($fieldName, 1, $id);

        $this->exercise->alterStatus($id);
        $this->exercise->alterStatus($id);

        try {
            $this->exercise->alterStatus($id);

            //ToDo see how to cleanly do in this kinda case
            throw new Exception("Unwanted success");
        } catch (Exception $e) {
            $this->assertEquals($e->getMessage(), 'Status is not supported for alteration.');
        }
    }
}
