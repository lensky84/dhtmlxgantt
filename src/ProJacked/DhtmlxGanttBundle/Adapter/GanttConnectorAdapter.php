<?php

namespace ProJacked\DhtmlxGanttBundle\Adapter;

use ProJacked\DhtmlxGanttBundle\Connector\GanttConnector;
use Doctrine\Bundle\DoctrineBundle\Registry;
use ProJacked\DhtmlxGanttBundle\Connector\DataItem\GanttDataItem;
use ProJacked\DhtmlxGanttBundle\Connector\DataProcessor\GanttDataProcessor;
use ProJacked\DhtmlxGanttBundle\DataSource\DataSourceInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class GanttConnectorAdapter
 * @package ProJacked\DhtmlxGanttBundle\Adapter
 */
class GanttConnectorAdapter
{
    /**
     * @var GanttConnector
     */
    protected $connector;

    /**
     * @var DataSourceInterface
     */
    protected $tasks;

    /**
     * @var DataSourceInterface
     */
    protected $links;

    /**
     * @var array
     */
    protected $taskFields;

    /**
     * @var array
     */
    protected $linkFields;

    /**
     * @var string
     */
    protected $idFieldName;

    /**
     * @var Registry
     */
    protected $registry;

    /**
     * GanttConnectorAdapter constructor.
     * @param $dataWrapper
     * @param RegistryInterface $registry
     */
    public function __construct($dataWrapper, RegistryInterface $registry)
    {
        $this->connector = new GanttConnector(null, $dataWrapper, GanttDataItem::class, GanttDataProcessor::class);
        $this->registry = $registry;
    }

    /**
     * @param DataSourceInterface $tasks
     * @param DataSourceInterface|null $links
     */
    public function configure(DataSourceInterface $tasks, DataSourceInterface $links = null)
    {
        $tasks->configure($this->registry);
        $this->tasks = $tasks;
        $this->idFieldName = $tasks->getIdFieldName();
        $this->taskFields = array_keys($tasks->getFields());

        if ($links) {
            $links->configure($this->registry);
            $this->links = $links;
            $this->linkFields = array_keys($links->getFields());
        }
    }

    /**
     *
     */
    public function render()
    {
        if ($this->links) {
            $this->connector->render_links($this->links, $this->idFieldName, implode(",", $this->linkFields));
        }

        $this->connector->render_table($this->tasks, $this->idFieldName, implode(",", $this->taskFields));
    }

    /**
     * @return GanttConnector
     */
    public function getConnector()
    {
        return $this->connector;
    }
}
