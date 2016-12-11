<?php

namespace AppBundle\Controller;

use AppBundle\Entity\GanttLinks;
use AppBundle\Entity\GanttTasks;
use Dhtmlx\Connector\GanttConnector;
use ProJacked\DhtmlxGanttBundle\Connector\DataItem\GanttDataItem;
use ProJacked\DhtmlxGanttBundle\DataSource\EntitySource;
use Sensio\Bundle\FrameworkExtraBundle\Configuration;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Configuration\Route("/data", name="app.get_data")
     */
    public function dataAction(Request $request)
    {
        $connector = $this->get('projacked_dhtmlxgantt.connector_adapter');
        $taskSource = new EntitySource(GanttTasks::class);
        $connector->configure($taskSource, new EntitySource(GanttLinks::class));
        $connector->render();
    }

    /**
     * @Configuration\Route("/")
     * @Configuration\Template()
     */
    public function indexAction()
    {
        return [];
    }
}
