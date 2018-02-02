<?php

use Ivoz\Cgr\Domain\Model\TpCdr\TpCdr;
use Ivoz\Cgr\Domain\Model\TpCdr\TpCdrDto;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Service\DataGateway;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrDto;


class IvozProvider_Klear_Ghost_TrunksCdr extends KlearMatrix_Model_Field_Ghost_Abstract
{
    /**
     * @param TrunksCdrDto $model
     * @return null|string
     * @throws Zend_Exception
     */
    public function getPrice($model)
    {
        /** @var DataGateway $dataGateway */
        $dataGateway = \Zend_Registry::get('data_gateway');

        $where = array(
            "TpCdr.cgrid = '" . $model->getCgrid() . "'",
            "TpCdr.runId = '*default'"
        );

        /** @var TpCdrDto $tpCdr */
        $tpCdr = $dataGateway->findOneBy(
            TpCdr::class,
            [
                implode(' AND ', $where),
            ]
        );

        if ($tpCdr) {
            return $tpCdr->getCost();
        }

        return $model->getPrice();
    }

    /**
     * @param TrunksCdrDto $model
     * @return null|string name of target based on route type
     * @throws Zend_Exception
     */
    public function getDuration($model)
    {
        /** @var DataGateway $dataGateway */
        $dataGateway = \Zend_Registry::get('data_gateway');

        $where = array(
            "TpCdr.cgrid = '" . $model->getCgrid() . "'",
            "TpCdr.runId = '*default'"
        );

        /** @var TpCdrDto $tpCdr */
        $tpCdr = $dataGateway->findOneBy(
            TpCdr::class,
            [
                implode(' AND ', $where),
            ]
        );

        if ($tpCdr) {
            return $tpCdr->getUsage() / (1000 * 1000 * 1000);
        }

        return round($model->getDuration());
    }

}
