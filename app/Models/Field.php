<?php

namespace App\Models;

use App\Core\Model;

class Field extends Model
{
    public int | null $id;
    public string | null $name;
    public FieldType | null $type;
    public int | null $exerciseId;
    private string $table = 'fields';
    private array $columns = ['id', 'name', 'type_id', 'exercise_id'];

    public function __construct(int $id = null, string $name = null, int $typeId = null, $exerciseId = null)
    {
        parent::__construct();

        $values = [
            'id' => $id,
            'name' => $name,
            'type_id' => $typeId,
            'exercise_id' => $exerciseId
        ];

        $this->setValues($values);
    }

    public function getFields(int $exerciseId = null): array
    {
        $filter = $exerciseId != null ? [['exercise_id', '=', $exerciseId]] : null;
        $values = $filter == null ?
            $this->db->select($this->table, $this->columns) :
            $this->db->select($this->table, $this->columns, $filter);

        $fields = [];

        foreach ($values as $value) {
            $id = $value["id"];
            $name = $value["name"];
            $typeId = $value["type_id"];
            $exerciseId = $value["exercise_id"];

            $fields[] = new Field($id, $name, $typeId, $exerciseId);
        }

        return $fields;
    }

    public function getField(int $fieldId): Field
    {
        $filter = [['id', '=', $fieldId]];
        $values = $this->db->select($this->table, $this->columns, $filter);

        $id = $values[0]["id"];
        $name = $values[0]["name"];
        $typeId = $values[0]["type_id"];
        $exerciseId = $values[0]["exercise_id"];

        return new Field($id, $name, $typeId, $exerciseId);
    }

    public function createField(string $name, string $typeId, int $exerciseId): Field | bool
    {
        $values = [
            $this->columns[1] => $name,
            $this->columns[2] => $typeId,
            $this->columns[3] => $exerciseId
        ];

        $result = $this->db->insert($this->table, $values);

        if (is_string($result)) {
            return $this->getField((int)$result);
        }

        return false;
    }

    public function deleteField(int $fieldId = null): bool
    {
        $condition = [[
            $this->columns[0],
            '=',
            $fieldId == null ? $this->id : $fieldId,
        ]];

        return $this->db->delete($this->table, $condition);
    }

    public function updateField(string $name, string $typeId, int $exerciseId, int $fieldId = null): bool
    {
        $values = [
            'name' => $name,
            'type_id' => $typeId,
            'exercise_id' => $exerciseId
        ];
        $condition = [[
            'id',
            '=',
            $fieldId == null ? $this->id : $fieldId,
        ]];

        $result = $this->db->update($this->table, $values, $condition);

        if ($result && $fieldId == null) {
            $this->setValues($values);
        }

        return $result;
    }

    private function setValues(array $values): void
    {
        $this->id = isset($values['id']) && $values['id'] != null ? $values['id'] : null;
        $this->name = isset($values['name']) && $values['name'] != null ? $values['name'] : null;
        $this->type = isset($values['type_id']) && $values['type_id'] != null ?
            (new FieldType())->getType($values['type_id']) :
            null;
        $this->exerciseId = isset($values['exercise_id']) && $values['exercise_id'] != null ?
            $values['exercise_id'] :
            null;
    }
}
