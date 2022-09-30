<?php

namespace Unit;

use Blog\Database;
use Blog\LatesPost;
use PDO;
use PDOStatement;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class LatestPostsTest extends TestCase
{
    private LatesPost $latesPost;

    protected function setUp(): void
    {
        $this->database = $this->getMockBuilder(Database::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->latesPost = new LatesPost($this->database);
    }

    public function testGet()
    {
        $limit = 2;
        $expectedPosts = ['post1', 'post2'];
        $statementMock = $this->getMockBuilder(PDOStatement::class)
            ->disableOriginalConstructor()
            ->getMock();

        $statementMock->expects($this->once())
            ->method('bindParam')
            ->will(
                $this->returnValue(':limit2'),
                $this->returnValue($limit),
                $this->returnValue(PDO::PARAM_INT)
            );

        $statementMock->expects($this->once())
            ->method('execute');
        $statementMock->expects($this->once())
            ->method('fetchAll')
            ->willReturn($expectedPosts);

        $pdoMock = $this->getMockBuilder(PDO::class)
            ->disableOriginalConstructor()
            ->getMock();

        $pdoMock->expects($this->once())
            ->method('prepare')
            ->will($this->returnValue('SELECT * FROM post ORDER BY published_date DESC LIMIT :limit'))
            ->willReturn($statementMock);

        $this->database->expects($this->once())
            ->method('getConnection')
            ->willReturn($pdoMock);

        $this->assertEquals($expectedPosts, $this->latesPost->get($limit));
    }
}