<?php

namespace Ivoz\Provider\Domain\Model\LcrRule;

use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;

/**
 * LcrRule
 */
class LcrRule extends LcrRuleAbstract implements LcrRuleInterface
{
    use LcrRuleTrait;

    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    protected $id;

//    public function setOutgoingRouting(OutgoingRoutingInterface $outgoingRouting)
//    {
//        $brandId = $outgoingRouting->getBrand()->getId();
//        if (!is_null($outgoingRouting->getCompany())) {
//            $companyId = $outgoingRouting->getCompany()->getId();
//            $this->setFromUri(
//                sprintf(
//                    '^b%dc%d$',
//                    $brandId,
//                    $companyId
//                )
//            );
//        } else {
//            $this->setFromUri(
//                sprintf(
//                    '^b%dc[0-9]+$',
//                    $brandId
//                )
//            );
//        }
//
//        return $this;
//    }

    public function setCondition($regexp)
    {
        if (is_numeric($regexp) || $regexp == 'fax') {
            $this->setPrefix($regexp);
            $this->setRequestUri(null);

            return $this;
        }

        $ruriRegexp = $regexp;
        if(substr($ruriRegexp, 0, 1) == '^') {
            $ruriRegexp = ':' . substr($ruriRegexp,1);
        }

        if(substr($ruriRegexp, -1) == '$') {
            $ruriRegexp = substr($ruriRegexp, 0, -1) . '@';
        }

        $this->setRequestUri($ruriRegexp);
        $this->setPrefix(null);

        return $this;
    }
}

