<?php

use PHPUnit\Framework\TestCase;
use App\Models\Status;

class TestStatus extends TestCase
{
    public function testGetStatus()
    {
        $response = Status::getStatus();

        $this->assertIsArray($response);
    }
}
