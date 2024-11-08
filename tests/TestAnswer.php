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
        $answer = new Answer(1);

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

        $return = $answer->update($updated_answer);

        $this->assertTrue($return);
        $this->assertEquals($updated_answer, $answer->answer);
    }
}
