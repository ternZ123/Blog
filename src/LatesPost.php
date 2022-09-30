<?php

declare(strict_types=1);

namespace Blog;


use PDO;

class LatesPost
{
    /**
     * @var Database
     */
    //private Database $database;


    /**
     * LatesPost constructor.
     * @param Database $database
     */
    public function __construct(Database $database)
    {
        $this->database=$database;
    }

    /**
     * @param int $limit
     * @return array|null
     */
    public function get(int $limit): ?array
    {
        $statement=$this->database->getConnection()->prepare(
            'SELECT * FROM post ORDER BY published_date  ASC LIMIT :limit');

        $statement->bindParam(':limit',$limit, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll();
    }
}