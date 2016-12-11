<?php

namespace ProJacked\DhtmlxGanttBundle\Connector\DataItem;

use Dhtmlx\Connector\Data\DataItem;

class GanttDataItem extends DataItem  {
    function to_xml(){
        $str="<task id='".$this->get_id()."' >";
        foreach($this->config->text as $config) {
            $property = $config['name'];
            if (isset($this->data[$property])) {
                $underscoreProperty = $this->camelCaseToUnderscore($property);
                $str .= "<" . $property . "><![CDATA[". $this->data[$property] ."]]></" . $property . ">";
                if ($underscoreProperty !== $property) {
                    $str .= "<" . $underscoreProperty . "><![CDATA[". $this->data[$property] ."]]></" . $underscoreProperty . ">";
                }
            }
        }

        if ($this->userdata !== false)
            foreach ($this->userdata as $key => $value)
                $str.="<".$key."><![CDATA[".$value."]]></".$key.">";

        return $str."</task>";
    }

    protected function camelCaseToUnderscore($string) {
        return strtolower(preg_replace(['/([a-z\d])([A-Z])/', '/([^_])([A-Z][a-z])/'], '$1_$2', $string));
    }
}
