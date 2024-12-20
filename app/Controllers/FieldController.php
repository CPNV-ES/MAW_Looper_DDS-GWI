<?php

namespace App\Controllers;

use App\Models\Exercise;
use App\Models\Field;

class FieldController
{
    public function publish($exerciseId)
    {
        $filter = [['id', '=', $exerciseId]];
        $exercise = Exercise::get($filter);

        if ($exercise->status->id != 1) {
            header('Location: /');
            return;
        }

        if (!isset($_POST['field']['label']) || !isset($_POST['field']['value_kind'])) {
            header('Location: /exercise/' . $exerciseId . '/fields');
        }

        $values = [
            'name' => $_POST['field']['label'],
            'type_id' => $_POST['field']['value_kind'],
            'exercise_id' => $exerciseId
        ];

        Field::insert($values);

        header('Location: /exercises/' . $exerciseId . '/fields');
    }

    public function edit($exerciseId, $fieldId)
    {
        $filter = [['id', '=', $exerciseId]];
        $exercise = Exercise::get($filter);

        if ($exercise->status->id != 1) {
            header('Location: /');
            return;
        }

        $filter = [['id', '=', $fieldId]];
        $field = Field::get($filter);

        require __DIR__ . "/../Views/field/edit.php";
    }

    public function delete($exerciseId, $fieldId)
    {
        $filter = [['id', '=', $exerciseId]];
        $exercise = Exercise::get($filter);

        if ($exercise->status->id != 1) {
            header('Location: /');
            return;
        }

        $filter = [['id', '=', $fieldId]];
        $delete = Field::delete($filter);

        header('Location: /exercises/' . $exerciseId . '/fields');
    }

    public function update($exerciseId, $fieldId)
    {
        $filter = [['id', '=', $exerciseId]];
        $exercise = Exercise::get($filter);

        if ($exercise->status->id != 1) {
            header('Location: /');
            return;
        }

        if (!isset($_POST['field']['label']) || !isset($_POST['field']['value_kind'])) {
            header('Location: /exercises/' . $exerciseId . '/fields');
        }

        $values = [
            'name' => $_POST['field']['label'],
            'type_id' => $_POST['field']['value_kind']
        ];
        $filter = [['id', '=', $fieldId]];

        Field::update($values, $filter);

        header('Location: /exercises/' . $exerciseId . '/fields');
    }
}