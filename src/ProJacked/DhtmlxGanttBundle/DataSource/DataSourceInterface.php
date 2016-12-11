<?php

namespace ProJacked\DhtmlxGanttBundle\DataSource;

use Doctrine\Common\Persistence\PersistentObject;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;

interface DataSourceInterface
{
    /**
     * @param RegistryInterface $registry
     * @return mixed
     */
    public function configure(RegistryInterface $registry);

    /**
     * @param QueryBuilder $queryBuilder
     * @return mixed
     */
    public function setQueryBuilder(QueryBuilder $queryBuilder);

    /**
     * @param array $data
     * @return mixed
     */
    public function setData(array $data);

    /**
     * @return EntityManagerInterface
     */
    public function getEntityManager();

    /**
     * @return PersistentObject|EntityRepository
     */
    public function getRepository();

    /**
     * @return string
     */
    public function getIdFieldName();

    /**
     * @return array
     */
    public function getFields();

    /**
     * @return array
     */
    public function getData();

}
