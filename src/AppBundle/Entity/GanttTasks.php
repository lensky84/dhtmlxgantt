<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ProJacked\DhtmlxGanttBundle\Domain\GanttInterface;

/**
 * GanttTasks
 *
 * @ORM\Table(name="gantt_tasks")
 * @ORM\Entity
 */
class GanttTasks implements GanttInterface
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
     * @var string
     *
     * @ORM\Column(name="text", type="string", length=255, nullable=false)
     */
    private $text;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_date", type="datetime", nullable=false)
     */
    private $startDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="duration", type="integer", nullable=false)
     */
    private $duration;

    /**
     * @var float
     *
     * @ORM\Column(name="progress", type="float", precision=10, scale=0, nullable=false)
     */
    private $progress;

    /**
     * @var float
     *
     * @ORM\Column(name="sortorder", type="float", precision=10, scale=0, nullable=false)
     */
    private $sortorder;

    /**
     * @ORM\OneToMany(targetEntity="GanttTasks", mappedBy="parent")
     */
    private $children;

    /**
     * @ORM\ManyToOne(targetEntity="GanttTasks", inversedBy="children")
     * @ORM\JoinColumn(name="parent", referencedColumnName="id")
     */
    private $parent;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deadline", type="datetime", nullable=true)
     */
    private $deadline;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="planned_start", type="datetime", nullable=true)
     */
    private $plannedStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="planned_end", type="datetime", nullable=true)
     */
    private $plannedEnd;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_date", type="datetime", nullable=true)
     */
    private $endDate;

    public function __construct()
    {
        $this->progress = 0;
        $this->sortorder = 0;
    }

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
     * Set text
     *
     * @param string $text
     * @return GanttTasks
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return GanttTasks
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set duration
     *
     * @param integer $duration
     * @return GanttTasks
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return integer
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set progress
     *
     * @param float $progress
     * @return GanttTasks
     */
    public function setProgress($progress)
    {
        $this->progress = $progress;

        return $this;
    }

    /**
     * Get progress
     *
     * @return float
     */
    public function getProgress()
    {
        return $this->progress;
    }

    /**
     * Set sortorder
     *
     * @param float $sortorder
     * @return GanttTasks
     */
    public function setSortorder($sortorder)
    {
        $this->sortorder = $sortorder;

        return $this;
    }

    /**
     * Get sortorder
     *
     * @return float
     */
    public function getSortorder()
    {
        return $this->sortorder;
    }

    /**
     * Set parent
     *
     * @param GanttTasks $parent
     * @return GanttTasks
     */
    public function setParent($parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return GanttTasks
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set deadline
     *
     * @param \DateTime $deadline
     * @return GanttTasks
     */
    public function setDeadline($deadline)
    {
        $this->deadline = $deadline;

        return $this;
    }

    /**
     * Get deadline
     *
     * @return \DateTime
     */
    public function getDeadline()
    {
        return $this->deadline;
    }

    /**
     * Set plannedStart
     *
     * @param \DateTime $plannedStart
     * @return GanttTasks
     */
    public function setPlannedStart($plannedStart)
    {
        $this->plannedStart = $plannedStart;

        return $this;
    }

    /**
     * Get plannedStart
     *
     * @return \DateTime
     */
    public function getPlannedStart()
    {
        return $this->plannedStart;
    }

    /**
     * Set plannedEnd
     *
     * @param \DateTime $plannedEnd
     * @return GanttTasks
     */
    public function setPlannedEnd($plannedEnd)
    {
        $this->plannedEnd = $plannedEnd;

        return $this;
    }

    /**
     * Get plannedEnd
     *
     * @return \DateTime
     */
    public function getPlannedEnd()
    {
        return $this->plannedEnd;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     * @return GanttTasks
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    public function getField()
    {
        return rand();
    }

    public function setField($field)
    {

    }

    public function getChildren()
    {
        return null;
    }
}
