<?php

namespace ProJacked\DhtmlxGanttBundle\Domain;

interface GanttInterface
{
    /**
     * @return mixed
     */
    public function getParent();

    /**
     * @param $parent
     * @return mixed
     */
    public function setParent($parent);

    /**
     * @return mixed
     */
    public function getText();

    /**
     * @param $text
     * @return mixed
     */
    public function setText($text);

    /**
     * @return mixed
     */
    public function getStartDate();

    /**
     * @param $startDate
     * @return mixed
     */
    public function setStartDate($startDate);

    /**
     * @return mixed
     */
    public function getDuration();

    /**
     * @param $duration
     * @return mixed
     */
    public function setDuration($duration);

    /**
     * @return mixed
     */
    public function getProgress();

    /**
     * @param $progress
     * @return mixed
     */
    public function setProgress($progress);
}
