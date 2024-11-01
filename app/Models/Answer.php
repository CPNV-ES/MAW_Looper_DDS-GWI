<?php

namespace App\Models;

use App\Core\Model;
use http\Exception;

class Answer extends Model
{
    public int | null $id;
    public string | null $answer;
    public int | Test | null $test;
    public int | Field | null $field;
    private string $table = 'tests_answer_fields';
    private array $columns = ['id', 'answer', 'test_id', 'field_id'];

    public function __construct(
        int $id = null,
        string $answer = null,
        int | Test $test = null,
        int | Field $field = null
    ) {
        parent::__construct();

        if ($id != null) {
            $this->getAnswer($id);
            return;
        }

        $this->answer = $answer;
        $this->test = $test;
        $this->field = $field;

        if ($answer != null && $field != null && $test != null) {
            $this->create($answer, $test, $field);
        }
    }

    public function getAnswer(int $id): Answer | false
    {
        $filter = [
            ['id', '=', $id],
        ];

        $answer = $this->db->select($this->table, $this->columns, $filter)[0] ?? null;

        if ($answer) {
            $this->id = $answer['id'];
            $this->answer = $answer['answer'];
            $this->test = $answer['test_id'];
            $this->field = $answer['field_id'];

            return $this;
        }

        return false;
    }

    public function create(string $answer, int | Test $test, int | Field $field): Answer | \Exception
    {
        $values = [
            'answer' => $answer,
            'test_id' => is_object($test) ? $test->id : $test,
            'field_id' => is_object($field) ? $field->id : $field,
        ];

        $id = $this->db->insert($this->table, $values);

        if ($id != null) {
            $this->id = $id;
            $this->answer = $answer;
            $this->test = $test;
            $this->field = $field;

            return $this;
        }

        throw new \Exception('Failed to create answer');
    }
}
