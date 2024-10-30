<?php

use PHPUnit\Framework\TestCase;
use App\Models\Database;

class TestDatabase extends TestCase
{
    private $database;

    public function setUp(): void
    {
        $this->database = new Database();
    }

    public function testCanSelectValues()
    {
        $table = 'exercises';
        $columns = ['id', 'name', 'status_id'];

        $values = $this->database->select($table, $columns);

        $this->assertIsArray($values);
        $this->assertNotEmpty($values);
    }

    public function testCanInsertValues()
    {
        $table = 'exercises';
        $columns = ['id'];

        $count_before = count($this->database->select($table, $columns));

        $value = [
            'name' => 'test',
            'status_id' => 1
        ];

        $result = $this->database->insert($table, $value);

        $count_after = count($this->database->select($table, $columns));

        $this->assertIsString($result);
        $this->assertNotEquals($count_before, $count_after);
    }

    public function testCanSelectWithFilters()
    {
        $table = 'exercises';
        $columns = ['id', 'name', 'status_id'];

        $first = $this->database->select($table, $columns);

        $filters = [
            ['id', '=', $first[0]['id']],
        ];

        $values = $this->database->select($table, $columns, $filters);

        $this->assertIsArray($values);
        $this->assertNotEmpty($values);
        $this->assertCount(1, $values);
    }

    public function testCanUpdateValues()
    {
        $table = 'exercises';
        $columns = ['id', 'name'];

        $first = $this->database->select($table, $columns);

        $filters = [
            ['id', '=', $first[0]['id']],
        ];

        $before = $this->database->select($table, $columns, $filters);

        $values = [
            'name' => $before[0]['name'] . 't',
        ];

        $result = $this->database->update($table, $values, $filters);

        $after = $this->database->select($table, $columns, $filters);

        $this->assertTrue($result);
        $this->assertNotEquals($after[0]['name'], $before[0]['name']);
    }

    public function testCanDeleteValues()
    {
        $table = 'exercises';
        $value = [
            'name' => 'test_delete',
            'status_id' => 1
        ];

        $this->database->insert($table, $value);

        $columns = ['id'];
        $filters = [
            ['name', '=', 'test_delete'],
        ];

        $before = count($this->database->select($table, $columns, $filters));

        $result = $this->database->delete($table, $filters);

        $after = count($this->database->select($table, $columns));

        $this->assertTrue($result);
        $this->assertNotEquals($before, $after);
    }
}
