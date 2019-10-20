<?php


namespace App\Repository;

use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\DBAL\DBALException;

class PostRepository extends ServiceEntityRepository
{
    private $connection;

    /**
     * PostRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
        $this->connection = $this->getEntityManager()->getConnection();
    }

    /**
     * @return mixed
     * @throws DBALException
     */
    public function getLastId()
    {
        $sql = "SHOW TABLE STATUS FROM `blog` WHERE `name`='post'";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        $aResult = $stmt->fetchAll();
        $result = $aResult['0']['Auto_increment'];

        return $result;
    }

}