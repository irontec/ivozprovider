<?php

namespace Ivoz\Provider\Infrastructure\Domain\Service\RoutingPattern;

use Ivoz\Core\Infrastructure\RoutingPattern\Service\XmlRpc\RequestProxyTrunksLcrReloadTrait;
use Ivoz\Provider\RoutingPattern\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface;

/**
 * Class RemovedSendXmlRcp
 * @package Ivoz\Provider\RoutingPattern\Service\RoutingPattern
 * @lifecycle post_remove
 */
class RemovedXmlRpc extends AbstractSendXmlRpc
{
    public function execute(RoutingPatternInterface $entity, $isNew)
    {
        // If any LcrRule uses this Pattern, update accordingly
        /**
         * @var LcrRuleInterface[] $lcrRules
         */
        $lcrRules = $entity->getLcrRules();

        if (empty($lcrRules)) {
            return;
        }

        try {
            parent::execute($entity, $isNew);
        } catch (\Exception $e) {
            $message = $e->getMessage() . '<p>Routing pattern may have been deleted.</p>';
            throw new \Exception($message);
        }
    }
}