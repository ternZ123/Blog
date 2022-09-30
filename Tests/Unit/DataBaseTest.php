<?php
declare(strict_types=1);
namespace Blog\Tests\Unit;

use Blog\Database;
use PDO;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class DataBaseTest extends TestCase
{


    protected function setUp(): void
    {
        $this->connection=$this->createMock(PDO::class);
        $this->database=new Database($this->connection);
    }

    public function testGetConnection():void
    {
        $result=$this->database->getConnection();
        $this->assertInstanceOf(PDO::class,$result);
    }
}