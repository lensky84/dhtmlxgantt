<?php

namespace ProJacked\DhtmlxGanttBundle\Connector\DataItem;

use Dhtmlx\Connector\Data\DataItem;

class GanttLinkDataItem extends DataItem  {

    public function to_xml_start() {
        $str="<item ";
        foreach($this->config->text as $config) {
            $property = $config['name'];
            if (isset($this->data[$property])) {
                $str .= $property . "='" . $this->xmlentities($this->data[$property]) . "' ";
            }
        }
        return $str.">";
    }
}
