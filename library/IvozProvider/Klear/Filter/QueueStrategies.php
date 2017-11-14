<?php

use Ivoz\Provider\Domain\Model\Queue\Queue;

class IvozProvider_Klear_Filter_QueueStrategies implements KlearMatrix_Model_Field_Select_Filter_Interface
{
    /**
     * @var \Ivoz\Provider\Domain\Model\Queue\QueueDTO
     */
    private $_queue = null;

    public function setRouteDispatcher(KlearMatrix_Model_RouteDispatcher $routeDispatcher)
    {
        $queueId = $routeDispatcher->getParam('pk', false);

        if ($queueId) {
            $dataGateway = \Zend_Registry::get('data_gateway');
            $this->_queue = $dataGateway->find(Queue::class, $queueId);
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
