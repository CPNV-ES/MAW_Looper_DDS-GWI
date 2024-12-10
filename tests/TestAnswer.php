<?php


use App\Models\Answer;
use PHPUnit\Framework\TestCase;

class TestAnswer extends TestCase
{
    public function testCanCreateAnswer()
    {
        $answer_text = "My Answer";
        $test = 1;
        $field = 1;

        $answer = new Answer(null, $answer_text, $test, $field);

        $this->assertIsObject($answer);
        $this->assertEquals($answer_text, $answer->answer);
    }

    public function testCanGetAnswerViaConstructor()
    {
        $answer = (new Answer())->getAnswer(1);

        $this->assertIsObject($answer);
        $this->assertIsString($answer->answer);
    }

    public function testCanGetAnswer()
    {
        $answer = new Answer();
        $answer = $answer->getAnswer(1);

        $this->assertIsObject($answer);
        $this->assertIsString($answer->answer);
    }

    public function testCanUpdateAnswer()
    {
        $answer = new Answer();
        $answer = $answer->getAnswer()[0];

        $old_answer = $answer->answer;
        $updated_answer = $old_answer . "new";
        $values = [
            "answer" => $updated_answer
        ];
        $filters = [
            [
                "id", "=", $answer->id
            ]
        ];

        $return = $answer->update($values, $filters);

        $this->assertTrue($return);
        $this->assertEquals($updated_answer, $answer->answer);
    }

    public function testCanGetAnswerByTest()
    {
        $answer = new Answer();
        $answers = $answer->getByTest(1);

        $this->assertIsArray($answers);
        $this->assertContainsOnlyInstancesOf(Answer::class, $answers);
    }

    public function testCanGetAnswerByField()
    {
        $answer = new Answer();
        $answers = $answer->getByField(1);

        $this->assertIsArray($answers);
        $this->assertContainsOnlyInstancesOf(Answer::class, $answers);
    }
}
