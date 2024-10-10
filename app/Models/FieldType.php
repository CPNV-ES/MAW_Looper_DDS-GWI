<?php

namespace App\Models;

use App\Core\Model;

class FieldType extends Model
{
    public int | null $id;
    public string | null $title;
    private string $table = 'types';
    private array $columns = ['id', 'title'];

    public function __construct(int $id = null, string $title = null)
    {
        parent::__construct();

        $values = [
            'id' => $id,
            'title' => $title
        ];

        $this->setValues($values);
    }

    public function getType(int $typeId): FieldType
    {
        $filter = [['id', '=', $typeId]];
        $values = $this->db->select($this->table, $this->columns, $filter);

        $id = $values[0]["id"];
        $title = $values[0]["title"];

        return new FieldType($id, $title);
    }

    private function setValues(array $values): void
    {
        $this->id = isset($values['id']) && $values['id'] != null ? $values['id'] : null;
        $this->title = isset($values['title']) && $values['title'] != null ? $values['title'] : null;
    }
}