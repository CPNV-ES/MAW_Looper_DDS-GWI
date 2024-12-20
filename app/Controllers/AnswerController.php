<?php

namespace App\Controllers;

use App\Models\Answer;
use App\Models\Exercise;
use App\Models\Field;
use App\Models\Fulfillment;

class AnswerController
{
    public function show($exerciseId)
    {
        //Block if $name is null or isn't a string of a number
        if ((!isset($exerciseId) || !ctype_digit($exerciseId))) {
            header('Location: /exercises');

            return;
        }

        $filter = [['id', '=', $exerciseId]];
        $exercise = Exercise::get($filter);

        $filter = [['exercise_id', '=', $exerciseId]];
        $fields = Field::get($filter);
        $fields = is_array($fields) ? $fields : [$fields];

        $fulfillments = Fulfillment::get($filter);

        $tableAnswers = [];

        if (is_bool($fulfillments)) {
            $fulfillments = [];

            require __DIR__ . "/../Views/answer/show.php";

            return;
        }

        $fulfillments = is_array($fulfillments) ? $fulfillments : [$fulfillments];

        foreach ($fulfillments as $fulfillment) {
            $filter = [['fulfillment_id', '=', $fulfillment->id]];
            $answer = Answer::get($filter);
            $tableAnswers[$fulfillment->id] = is_object($answer) ? [$answer] : $answer;
        }

        require __DIR__ . "/../Views/answer/show.php";
    }

    public function showByFulfillment($exerciseId, $fulfillmentId)
    {
        //Block if $name is null or isn't a string of a number
        if ((!isset($exerciseId) || !ctype_digit($exerciseId)) || (!isset($fulfillmentId) || !ctype_digit($fulfillmentId))) {
            header('Location: /exercises');

            return;
        }

        $filter = [['id', '=', $exerciseId]];
        $exercise = Exercise::get($filter);

        $filter = [['exercise_id', '=', $exerciseId]];
        $fields = Field::get($filter);
        $fields = is_array($fields) ? $fields : [$fields];

        $filter = [['fulfillment_id', '=', $fulfillmentId]];
        $answers = Answer::get($filter);
        $answers = is_array($answers) ? $answers : [$answers];

        $fields_ids = [];
        foreach ($fields as $field) {
            $fields_ids[] = $field->id;
        }

        $answers = array_combine($fields_ids, $answers);

        require __DIR__ . "/../Views/answer/showByFulfillment.php";
    }

    public function showByField($exerciseId, $fieldId)
    {
        //Block if $name is null or isn't a string of a number
        if ((!isset($exerciseId) || !ctype_digit($exerciseId)) || (!isset($fieldId) || !ctype_digit($fieldId))) {
            header('Location: /exercises');

            return;
        }

        $filter = [['id', '=', $exerciseId]];
        $exercise = Exercise::get($filter);

        $filter = [['id', '=', $fieldId]];
        $field = Field::get($filter);

        $filter = [['exercise_id', '=', $exerciseId]];
        $fulfillments = Fulfillment::get($filter);
        $fulfillments = is_object($fulfillments) && !is_bool($fulfillments) ? [$fulfillments] : $fulfillments;
        $fulfillments = is_array($fulfillments) ? $fulfillments : [];

        $tableAnswers = [];

        foreach ($fulfillments as $fulfillment) {
            $filter = [
                ['fulfillment_id', '=', $fulfillment->id],
                ['field_id', '=', $fieldId]
            ];
            $tableAnswers[$fulfillment->id] = Answer::get($filter);
        }

        require __DIR__ . "/../Views/answer/showByField.php";
    }

    public function create(int $exerciseId)
    {
        $filter = [['id', '=', $exerciseId]];
        $exercise = Exercise::get($filter);

        if ($exercise->status->id != 2) {
            header("Location: /");
            return;
        }

        $filter = [['exercise_id', '=', $exercise->id]];
        $fields = Field::get($filter);
        $fields = is_object($fields) ? [$fields] : $fields;

        require __DIR__ . "/../Views/answer/create.php";
    }

    public function publish(int $exerciseId)
    {
        $timestamp = (new \DateTime('now'))->format('Y-m-d H:i:s');
        $values = [
            'timestamp_fulfillment' => $timestamp,
            'exercise_id' => $exerciseId,
        ];
        $fulfillment = Fulfillment::insert($values);

        foreach ($_POST['field'] as $fieldId => $value) {
            $values = [
                'answer' => $value,
                'fulfillment_id' => (int)$fulfillment,
                'field_id' => $fieldId
            ];
            $answer = Answer::insert($values);
        }

        header('Location: /exercises/' . $exerciseId . '/fulfillments/' . (int)$fulfillment . '/edit');
    }

    public function edit(int $exerciseId, int $fulfillmentId)
    {
        $filter = [['id', '=', $exerciseId]];
        $exercise = Exercise::get($filter);

        if ($exercise->status->id != 2) {
            header("Location: /");
            return;
        }

        $filter = [['exercise_id', '=', $exerciseId]];
        $fields = Field::get($filter);
        $fields = is_bool($fields) ? [] : $fields;
        $fields = is_array($fields) ? $fields : [$fields];

        $filter = [['fulfillment_id', '=', $fulfillmentId]];
        $answers = Answer::get($filter);
        $answers = is_object($answers) ? [$answers] : $answers;

        $fields_ids = array_map(
            function ($field) {
                return $field->id;
            },
            $fields
        );

        $answers = array_combine($fields_ids, $answers);

        require __DIR__ . "/../Views/answer/edit.php";
    }

    public function update(int $exerciseId, int $fulfillmentId)
    {
        foreach ($_POST['field'] as $fieldId => $value) {
            $values = [
                'answer' => $value
            ];
            $filters = [
                ['field_id', '=', $fieldId],
                ['fulfillment_id', '=', $fulfillmentId]
            ];

            Answer::update($values, $filters);
        }

        header('Location: /exercises/' . $exerciseId . '/fulfillments/' . $fulfillmentId . '/edit');
    }
}