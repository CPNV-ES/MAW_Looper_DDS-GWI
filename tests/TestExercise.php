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
        $name = 'Test Exercise Creation';

        $response = $this->exercise->create($name);

        $this->assertIsInt($response);

        //ToDo make deletion of exercise after all tests
    }

    public function testCanGetExercises()
    {
        $exerciseName = 'Test Exercise Alter Status';
        $fieldName = 'Test Field Alter Status';

        $exerciseIdNoField = $this->exercise->create($exerciseName);
        $exerciseIdWithField = $this->exercise->create($exerciseName);
        $this->field->createField($fieldName, 1, $exerciseIdWithField);

        $exercise = $this->exercise->getExercises($exerciseIdWithField);
        $exercises = $this->exercise->getExercises();

        $this->assertEquals($exerciseName, $exercise->name);
        $this->isInstanceOf(Exercise::class, $exercise);

        $this->assertIsArray($exercises);
        $this->assertContainsOnlyInstancesOf(Exercise::class, $exercises);
    }

    public function testCanGetExercise()
    {
        $exercise = (new Exercise())->getExercises(1);

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
            $this->assertEquals('Status change is not allowed', $e->getMessage());
        }
    }

    public function testCanAlterBuilding()
    {
        $exerciseName = 'Test Exercise Alter Status';
        $fieldName = 'Test Field Alter Status';

        $id = $this->exercise->create($exerciseName);
        $this->field->createField($fieldName, 1, $id);

        $exercise = $this->exercise->getExercises($id);

        $this->assertCount(1, $exercise->fields);

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
            $this->assertEquals('Status is not supported for alteration.', $e->getMessage());
        }
    }

    public function testCantDeleteExerciseAnswering()
    {
        $exerciseName = 'Test Exercise Deletion';
        $fieldName = 'Test Field Deletion';

        $id = $this->exercise->create($exerciseName);
        $this->field->createField($fieldName, 1, $id);
        $this->exercise->alterStatus($id);

        try {
            $this->exercise->delete($id);

            //ToDo see how to cleanly do in this kinda case
            throw new Exception("Unwanted success");
        } catch (Exception $e) {
            $this->assertEquals('Status is not supported for deletion.', $e->getMessage());
        }
    }

    public function testCanDeleteExerciseBuilding()
    {
        $exerciseName = 'Test Exercise Deletion';

        $id = $this->exercise->create($exerciseName);

        $response = $this->exercise->delete($id);

        $this->assertTrue($response);
    }

    public function testCanDeleteExerciseClosed()
    {
        $exerciseName = 'Test Exercise Deletion';
        $fieldName = 'Test Field Deletion';

        $id = $this->exercise->create($exerciseName);
        $this->field->createField($fieldName, 1, $id);
        $this->exercise->alterStatus($id);
        $this->exercise->alterStatus($id);

        $response = $this->exercise->delete($id);

        $this->assertTrue($response);
    }
}
