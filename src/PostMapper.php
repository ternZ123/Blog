<?php
declare(strict_types=1);

namespace Blog;

use Exception;
use PDO;

class PostMapper
{
    /**
     * @var PDO
     */
    //private PDO $connection;

    /**
     * PostMapper constructor.
     * @param PDO $connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection=$connection;
    }

    /**
     * @param string $urlkey
     * @return array|null
     */
    public function getByUrlKey(string $urlkey):?array
    {
        $statement=$this->connection->prepare('SELECT * FROM post WHERE url_key =:url_key');
        $statement->execute([
            'url_key'=>$urlkey
        ]);
        $result=$statement->fetchAll();
        return array_shift($result);
    }

    /**
     * @param string $direction
     * @return array|null
     * @throws Exception
     */
    public function getList(string $direction):?array
    {
        if(!in_array($direction,['ASC','DESC'])){
          throw new Exception('The direction in not supported');
        }
        $statement=$this->connection->prepare('SELECT * FROM post ORDER BY published_date '.$direction);

        $statement->execute();
        return $statement->fetchAll();
    }

}