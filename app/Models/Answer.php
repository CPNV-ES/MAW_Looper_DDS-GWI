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

        if ($field != null && $test != null) {
            $this->create($answer, $test, $field);
        }
    }

    public function getAnswer(int $id = null): Answer | array | false
    {
        $filter = [
            ['id', '=', $id],
        ];

        $answer = $id == null ?
            $this->db->select($this->table, $this->columns) :
            $this->db->select($this->table, $this->columns, $filter)[0];

        if ($answer && isset($answer['id'])) {
            $this->id = $answer['id'];
            $this->answer = $answer['answer'];
            $this->test = $answer['test_id'];
            $this->field = $answer['field_id'];

            return $this;
        }

        if (count($answer) > 0) {
            $answers = [];

            foreach ($answer as $value) {
                $new_answer = new Answer($value['id'], $value['answer'], $value['test_id'], $value['field_id']);

                $answers[] = $new_answer;
            }

            return $answers;
        }

        return false;
    }

    public function getByTest(int $test_id): array | false
    {
        $filter = [
            ['test_id', '=', $test_id],
        ];

        $answers = $this->db->select($this->table, $this->columns, $filter);

        if ($answers && count($answers) > 0) {
            $answers_list = [];

            foreach ($answers as $answer) {
                $new_answer = new Answer($answer['id'], $answer['answer'], $answer['test_id'], $answer['field_id']);

                $answers_list[$answer['field_id']] = $new_answer;
            }

            return $answers_list;
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

    public function update(array $values, array $filters): bool
    {
        $response = $this->db->update($this->table, $values, $filters);

        if ($response) {
            $this->answer = $values['answer'];
            return true;
        }

        return false;
    }
}
