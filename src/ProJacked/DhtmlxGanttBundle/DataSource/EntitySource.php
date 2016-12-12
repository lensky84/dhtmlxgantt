<?php

namespace ProJacked\DhtmlxGanttBundle\DataSource;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use ProJacked\DhtmlxGanttBundle\Domain\GanttInterface;
use ProJacked\DhtmlxGanttBundle\Domain\GanttLinkInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;

class EntitySource implements DataSourceInterface
{
    /**
     * @var string
     */
    protected $entityClass;

    /**
     * @var EntityManagerInterface
     */
    protected $manager;

    /**
     * @var QueryBuilder
     */
    protected $queryBuilder;

    /**
     * @var array
     */
    protected $data;

    /**
     * EntitySource constructor.
     * @param string $entityClass
     * @throws \Exception
     */
    public function __construct($entityClass)
    {
        if (!(in_array(GanttInterface::class, class_implements($entityClass))
            || in_array(GanttLinkInterface::class, class_implements($entityClass)))) {
            throw new \Exception(
                sprintf(
                    "Either %s or %s are supported",
                    GanttInterface::class,
                    GanttLinkInterface::class
                )
            );
        }
        $this->entityClass = $entityClass;
    }

    /**
     * @return string
     */
    public function getEntityClass()
    {
        return $this->entityClass;
    }

    /**
     * @param RegistryInterface $registry
     * @return $this
     */
    public function configure(RegistryInterface $registry)
    {
        $this->manager = $registry->getEntityManagerForClass($this->entityClass);

        return $this;
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectRepository
     */
    public function getRepository()
    {
        return $this->manager->getRepository($this->entityClass);
    }

    /**
     * @return EntityManagerInterface
     */
    public function getEntityManager()
    {
        return $this->manager;
    }

    /**
     * @param QueryBuilder $queryBuilder
     * @return $this
     */
    public function setQueryBuilder(QueryBuilder $queryBuilder)
    {
        $this->queryBuilder = $queryBuilder;

        return $this;
    }

    /**
     * @return QueryBuilder
     */
    public function getQueryBuilder()
    {
        return $this->queryBuilder;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function setData(array $data = []) {
        $this->data = $data;

        return $this;
    }

    /**
     * @return array
     */
    public function getData()
    {
        if ($this->data) {
            return $this->data;
        } elseif ($this->queryBuilder) {
            return $this->queryBuilder->getQuery()->getResult();
        } else {
            return $this->getRepository()->findAll();
        }
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function getIdFieldName()
    {
        $classMetadata = $this->manager->getClassMetadata($this->entityClass);
        $identifiers = $classMetadata->getIdentifierFieldNames();
        if (count($identifiers) > 1) {
            throw new \Exception("Composite keys aren's supported now");
        }

        return $identifiers[0];
    }

    /**
     * @return array
     */
    public function getFields()
    {
        $classMetadata = $this->manager->getClassMetadata($this->entityClass);
        $fields = [];
        foreach ($classMetadata->getFieldNames() as $name) {
            $fields[$name] = [
                'association' => false,
                'type' => $classMetadata->getTypeOfField($name)
            ];
        }

        $associations = $classMetadata->getAssociationNames();
        foreach ($associations as $name) {
            $fields[$name] = [
                'association' => $classMetadata->getAssociationTargetClass($name),
                'type' => $classMetadata->getTypeOfField($name)
            ];

        }

        return $fields;
    }

    /**
     * @return array
     */
    public function getRelations()
    {
        $classMetadata = $this->manager->getClassMetadata($this->entityClass);
        $identifiers = $classMetadata->getAssociationNames();
        return $identifiers;

    }
}
