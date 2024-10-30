<?php

use App\Models\Field;
use PHPUnit\Framework\TestCase;

class TestField extends TestCase
{
    public function testCanCreateField()
    {
        $field = (new Field())->createField('TestCreateField', 1, 1);

        $this->assertEquals(Field::class, get_class($field));
    }

    public function testCanGetFields()
    {
        $field = (new Field())->createField('TestCreateField', 1, 1);
        $fields = (new Field())->getFields(1);

        $this->assertIsArray($fields);
        $this->assertNotEmpty($fields);
    }

    public function testCanGetField()
    {
        $newField = (new Field())->createField('TestCreateField', 1, 1);
        $field = (new Field())->getField($newField->id);

        $this->assertEquals(Field::class, get_class($field));
        $this->assertEquals($newField->id, $field->id);
    }

    public function testCanDeleteOwnField()
    {
        $field = (new Field())->createField('TestCreateField', 1, 1);

        $result = $field->deleteField();

        $this->assertTrue($result);
    }

    public function testCanDeleteAField()
    {
        $field = new Field();

        $fields = $field->getFields();

        $result = $field->deleteField($fields[0]->id);

        $this->assertTrue($result);
    }

    public function testCanUpdateOwnField()
    {
        $fields = (new Field())->getFields();
        $field = $fields[0];
        $nameBackup = $field->name;

        $result = $field->updateField($field->name . 'updatetest', 1, 1);

        $this->assertTrue($result);
        $this->assertNotEquals($nameBackup, $field->name);
    }

    public function testCanUpdateAField()
    {
        $fields = (new Field())->getFields();
        $fieldBefore = $fields[0];

        $result = (new Field())->updateField($fieldBefore->name . 'updatetest', 1, 1, $fieldBefore->id);

        $fieldAfter = (new Field())->getField($fieldBefore->id);

        $this->assertTrue($result);
        $this->assertNotEquals($fieldAfter->name, $fieldBefore->name);
    }
}
