<?php

use \IvozProvider\Mapper\Sql as Mapper;

class IvozProvider_Klear_Filter_QueueStrategies implements KlearMatrix_Model_Field_Select_Filter_Interface
{
    private $_queue = null;

    public function setRouteDispatcher(KlearMatrix_Model_RouteDispatcher $routeDispatcher)
    {
        $queueId = $routeDispatcher->getParam('pk', false);
        if ($queueId) {
            $queueMapper = new Mapper\Queues;
            $this->_queue = $queueMapper->find($queueId);
        }
        return true;
    }

    /**
     * Remove 'linear' from Strategy selectbox once Queue has been created.
     * See: https://issues.asterisk.org/jira/browse/ASTERISK-17049
     *
     * @return array
     */
    public function getCondition()
    {
        $excludedStrategies = [];

        if ($this->_queue && $this->_queue->getStrategy() != 'linear') {
            $excludedStrategies[] = 'linear';
        }

        return $excludedStrategies;
    }

}
