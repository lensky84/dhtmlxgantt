<?php

namespace ProJacked\DhtmlxGanttBundle\Domain;

interface GanttLinkInterface
{
    /**
     * @return mixed
     */
    public function getTarget();

    /**
     * @param $target
     * @return mixed
     */
    public function setTarget($target);

    /**
     * @return mixed
     */
    public function getSource();

    /**
     * @param $source
     * @return mixed
     */
    public function setSource($source);

    /**
     * @return mixed
     */
    public function getType();

    /**
     * @param $type
     * @return mixed
     */
    public function setType($type);
}
