<?php

declare(strict_types=1);

namespace Blog;

use PDO ;

class Database
{
    /**
     * @param PDO $connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @return PDO
     */
    public function getConnection():PDO
    {
        return $this->connection;
    }
}