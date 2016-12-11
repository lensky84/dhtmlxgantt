<?php

namespace ProJacked\DhtmlxGanttBundle\Connector;

use Dhtmlx\Connector\GanttLinksConnector;
use ProJacked\DhtmlxGanttBundle\Connector\DataItem\GanttLinkDataItem;

class GanttConnector extends \Dhtmlx\Connector\GanttConnector  {

    public function render_links($table,$id="",$fields=false,$extra=false) {
        $links = new GanttLinksConnector($this->get_connection(),$this->names["db_class"], GanttLinkDataItem::class);

        if($this->live_update)
            $links->enable_live_update($this->live_update->get_table());

        $links->render_table($table,$id,$fields,$extra);
        $this->set_options("links", $links);
        $this->links_table = $table;
    }
}
