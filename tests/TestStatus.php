<?php

use PHPUnit\Framework\TestCase;
use App\Models\Status;

class TestStatus extends TestCase
{
    public function testGetAllStatus()
    {
        $arrayStatus = Status::getStatus();

        $this->assertIsArray($arrayStatus);
        $this->assertNotEmpty($arrayStatus);
        $this->assertContainsOnlyInstancesOf(Status::class, $arrayStatus);
    }

    public function testCanGetStatusById()
    {
        $status = Status::getStatus(1);

        $this->assertInstanceOf(Status::class, $status);
    }

    public function testCantGetStatusById()
    {
        try {
            Status::getStatus(0);

            //ToDo see how to cleanly do in this kinda case
            throw new Exception('Unwanted success');
        } catch (Exception $e) {
            $this->assertEquals('Status not found', $e->getMessage());
        }
    }

    public function testCanGetStatusByTitle()
    {
        $status = Status::getStatusByTitle('Building');

        $this->assertInstanceOf(Status::class, $status);
    }

    public function testCantGetStatusByTitle()
    {
        try {
            Status::getStatusByTitle('Nothing');

            //ToDo see how to cleanly do in this kinda case
            throw new Exception('Unwanted success');
        } catch (Exception $e) {
            $this->assertEquals('Status not found', $e->getMessage());
        }
    }
}
