<?php

namespace ProJacked\DhtmlxGanttBundle\Connector\DataProcessor;

use Dhtmlx\Connector\DataProcessor\DataProcessor;

class GanttDataProcessor extends DataProcessor  {

    function name_data($data){

        foreach ($this->config->text as $config) {
            if ($config['name'] == $data || $this->camelCaseToUnderscore($config['name']) == $data) {
                return $config['name'];
            }
        }

        return $data;
    }

    protected function camelCaseToUnderscore($string) {
        return strtolower(preg_replace(['/([a-z\d])([A-Z])/', '/([^_])([A-Z][a-z])/'], '$1_$2', $string));
    }

}
