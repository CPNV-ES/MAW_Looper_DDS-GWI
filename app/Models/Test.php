<?php

namespace App\Models;

use App\Core\Model;
use DateTime;

class Test extends Model
{
    public int | null $id;
    public \DateTime | null $timestamp;
    public int | Exercise | null $exercise;
    private string $table = 'tests';
    private array $columns = ['id', 'timestamp_test', 'exercise_id'];

    public function __construct(int $id = null, \DateTime $timestamp = null, int | Exercise $exercise = null)
    {
        parent::__construct();

        if ($id != null) {
            $this->getTest($id);
            return;
        }

        $this->timestamp = $timestamp;
        $this->exercise = $exercise;

        if ($timestamp != null && $exercise != null) {
            $this->create($timestamp, $exercise);
        }
    }

    public function getTest(int $id): Test | false
    {
        $filter = [
            ['id', '=', $id],
        ];

        $test = $this->db->select($this->table, $this->columns, $filter)[0] ?? null;

        if ($test != null) {
            $this->id = $test['id'];
            $this->timestamp = new DateTime($test['timestamp_test']);
            $this->exercise = $test['exercise_id'];

            return $this;
        }

        return false;
    }

    public function create(\DateTime $timestamp, int | Exercise $exercise): Test | \Exception
    {
        $values = [
            'timestamp_test' => $timestamp->format('Y-m-d H:i:s'),
            'exercise_id' => is_object($exercise) ? $exercise->id : $exercise,
        ];

        $id = $this->db->insert($this->table, $values);

        if ($id) {
            $this->id = $id;
            $this->timestamp = $timestamp;
            $this->exercise = $exercise;

            return $this;
        }

        throw new \Exception('Failed to create test');
    }
}
