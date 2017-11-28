<?php

class IvozProvider_Klear_Ghost_RouteTarget extends KlearMatrix_Model_Field_Ghost_Abstract
{
    /**
     * @param \Ivoz\Provider\Domain\Model\Ivr\IvrDTO $model
     * @return null|string name of target based on route type
     */
    public function getIvrNoInputTarget($model)
    {
        return $this->getTarget($model, 'getNoInputTarget');
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Ivr\IvrDTO $model
     * @return null|string name of target based on route type
     */
    public function getIvrErrorTarget($model)
    {
        return $this->getTarget($model, 'getErrorTarget');
    }

    /**
     * @param \Ivoz\Core\Application\DataTransferObjectInterface $model
     * @return null|string name of target based on route type
     */
    public function getTarget(
        \Ivoz\Core\Application\DataTransferObjectInterface $model,
        string $method = 'getTarget'
    )
    {
        /** @var \Ivoz\Core\Application\Service\DataGateway $dataGateway */
        $dataGateway = \Zend_Registry::get('data_gateway');

        // Get entity name from the DTO
        $entityName = substr(get_class($model), 0,-3);

        return $dataGateway->remoteProcedureCall(
            $entityName,
            $model->getId(),
            $method,
            []
        );

    }

}
