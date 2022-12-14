<?php
declare(strict_types=1);

namespace Blog;

use Exception;

class PostMapper
{
    /**
     *
     */
    //private Database $database;

    /**
     * @param Database $database
     */
    public function __construct(Database $database)
    {
        $this->database=$database;
    }

    /**
     * @param string $urlkey
     * @return array|null
     */
    public function getByUrlKey(string $urlkey):?array
    {
        $statement=$this->database->getConnection()->prepare('SELECT * FROM post WHERE url_key =:url_key');
        $statement->execute([
            'url_key'=>$urlkey
        ]);
        $result=$statement->fetchAll();
        return array_shift($result);
    }

    /**
     * @param int $page
     * @param int $limit
     * @param string $direction
     * @return array|null
     * @throws Exception
     */
    public function getList(int $page=1,int $limit=2, string $direction='ASC'):?array
    {
        if(!in_array($direction,['ASC','DESC'])){
          throw new Exception('The direction in not supported');

        }
        $start=($page-1) * $limit;

        $statement=$this->database->getConnection()->prepare(
            'SELECT * FROM post ORDER BY published_date '.$direction.' LIMIT '.$start . ',' . $limit);

        $statement->execute();
        return $statement->fetchAll();
    }

    public function getTotalCount():int
    {
        $statement=$this->database->getConnection()->prepare('SELECT count(post_id) as total FROM post');
        $statement->execute();

        return (int)($statement->fetchColumn()?? 0);

    }
}