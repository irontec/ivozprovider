<?php

namespace Ivoz\Provider\Domain\Service\TransformationRuleSet;

use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface;
use Ivoz\Kam\Domain\Model\TrunksDialplan\TrunksDialplanInterface;
use Ivoz\Kam\Domain\Model\TrunksDialplan\TrunksDialplanRepository;

/**
 * Class SanitizeValues
 * @package Ivoz\Provider\Domain\Service\TransformationRuleSet
 * @lifecycle pre_persist
 */
class SanitizeValues implements TransformationRuleSetLifecycleEventHandlerInterface
{
    /**
     * @var TrunksDialplanRepository
     */
    protected $trunksDialplanRepository;

    public function __construct(
        TrunksDialplanRepository $trunksDialplanRepository
    ) {
        $this->trunksDialplanRepository = $trunksDialplanRepository;
    }

    public function execute(TransformationRuleSetInterface $entity, $isNew)
    {
        if ($isNew && $entity->getAutomatic()) {
            $cc = $entity->getCountry()->getCountryCode();
            $intcode = $entity->getInternationalCode();

            /**
             * @var TrunksDialplanInterface $maxDpiModel
             */
            $maxDpiModel = $this->trunksDialplanRepository->findBy(
                null,
                ['dpid' => 'DESC']
            );

            $dpid = 1;
            if (!is_null($maxDpiModel)) {
                // Calculate next dpid
                $dpid = $maxDpiModel->getDpid() + 1;
            }

            // Callee Out rules
            $entity->setCalleeOut($dpid++);

            // Caller Out rules
            $entity->setCallerOut($dpid++);

            // Callee In rules
            $entity->setCalleeIn($dpid++);

            // Caller In rules
            $entity->setCallerIn($dpid);
        }
    }
}