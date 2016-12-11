<?php

namespace Dhtmlx\Connector\DataStorage;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessor;

class DoctrineDBDataWrapper extends DataWrapper
{
    /**
     * {@inheritdoc}
     */
    public function get_variants($name, $source)
    {
        // TODO: Implement get_variants() method.
    }

    /**
     * {@inheritdoc}
     */
    public function get_next($res)
    {
        if ($res->index < sizeof($res->data))
            return $res->data[$res->index++];
    }

    /**
     * {@inheritdoc}
     */
    public function select($source)
    {
        $dataSource = $source->get_source();
        $data = [];
        $fields = $dataSource->getFields();
        $propertyAccessor = new PropertyAccessor();
        foreach ($dataSource->getData() as $resultItem) {
            $dataItem = [];
            foreach ($fields as $fieldName => $config) {
                if ($propertyAccessor->isReadable($resultItem, $fieldName)) {
                    $value = $propertyAccessor->getValue($resultItem, $fieldName);
                    if ($config['association'] && $value) {
                        $value = $value->getId();
                    } elseif ($value instanceof \DateTimeInterface) {
                        $value = $value->format("Y-m-d H:i:s");
                    }
                    $dataItem[$fieldName] = $value;
                }
            }

            $data[] = $dataItem;
        }

        return new ArrayQueryWrapper($data);
    }

    /**
     * {@inheritdoc}
     */
    public function insert($data, $source)
    {
        $entityClass = $source->get_source()->getEntityClass();
        $entity = new $entityClass();

        return $this->saveEntity($data, $source, $entity);
    }

    /**
     * {@inheritdoc}
     */
    public function update($data, $source)
    {
        $repository = $source->get_source()->getRepository();
        $entity = $repository->find($data->get_id());
        if (!$entity) {
            $data->invalid();
            $data->set_response_attribute("error", "Unable to find entity");
        }

        return $this->saveEntity($data, $source, $entity);
    }

    /**
     * {@inheritdoc}
     */
    public function get_size($source)
    {
        // TODO: Implement get_size() method.
    }

    /**
     * {@inheritdoc}
     */
    public function delete($data, $source)
    {
        $repository = $source->get_source()->getRepository();
        $entity = $repository->find($data->get_id());
        if (!$entity) {
            $data->invalid();
            $data->set_response_attribute("error", "Unable to find entity");
        }

        try {
            $manager = $source->get_source()->getEntityManager();
            $manager->remove($entity);
            $manager->flush();
            $data->success();
        } catch (\Exception $e) {
            $data->invalid();
            $data->set_response_attribute("error", $e->getMessage());
        }
    }

    /**
     * {@inheritdoc}
     */
    public function is_global_transaction()
    {
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function is_record_transaction()
    {
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function escape()
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function query()
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function new_record_order($action, $source)
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    protected function saveEntity($data, $source, $entity)
    {
        $dataSource = $source->get_source();
        $manager = $dataSource->getEntityManager();
        $fields = $dataSource->getFields();
        $propertyAccessor = new PropertyAccessor();

        try {
            foreach ($data->get_data() as $property => $value) {
                if (isset($fields[$property]) && $fields[$property]['type'] === 'datetime') {
                    $value = new \DateTime($value);
                }

                if ($propertyAccessor->isWritable($entity, $property) && isset($fields[$property])) {
                    if ($associationClass = $fields[$property]['association']) {
                        $repository = $manager->getRepository($associationClass);
                        $association = $repository->find($value);
                        if ($association) {
                            $propertyAccessor->setValue($entity, $property, $association);
                        }
                    } else {
                        $propertyAccessor->setValue($entity, $property, $value);
                    }
                }
            }
            $manager->persist($entity);
            $manager->flush();
            $data->set_new_id($propertyAccessor->getValue($entity, $dataSource->getIdFieldName()));
            $data->success();
        } catch (\Exception $e) {
            $data->invalid();
            $data->set_response_attribute("error", $e->getMessage());
        }
    }
}
