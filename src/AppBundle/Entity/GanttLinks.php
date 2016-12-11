<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ProJacked\DhtmlxGanttBundle\Domain\GanttLinkInterface;

/**
 * GanttLinks
 *
 * @ORM\Table(name="gantt_links")
 * @ORM\Entity
 */
class GanttLinks implements GanttLinkInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="source", type="integer", nullable=false)
     */
    private $source;

    /**
     * @var integer
     *
     * @ORM\Column(name="target", type="integer", nullable=false)
     */
    private $target;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=false)
     */
    private $type;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set source
     *
     * @param integer $source
     * @return GanttLinks
     */
    public function setSource($source)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Get source
     *
     * @return integer
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Set target
     *
     * @param integer $target
     * @return GanttLinks
     */
    public function setTarget($target)
    {
        $this->target = $target;

        return $this;
    }

    /**
     * Get target
     *
     * @return integer
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return GanttLinks
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
}
