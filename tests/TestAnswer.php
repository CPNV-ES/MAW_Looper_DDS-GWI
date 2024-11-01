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
}
