<?php

namespace Ivoz\Kam\Domain\Service\TrunksDialplan;

use Ivoz\Kam\Domain\Model\TrunksDialplan\TrunksDialplanInterface;
use Ivoz\Kam\Domain\Model\TrunksDialplan\TrunksDialplanRepository;

/**
 * Class AssignDpid
 * @package Ivoz\Kam\Domain\Service\TrunksDialplan
 * @lifecycle pre_persist
 */
class AssignDpid implements TrunksDialplanLifecycleEventHandlerInterface
{
    use CreateDialplanRuleDtoTrait;

    /**
     * @var TrunksDialplanRepository
     */
    protected $trunksDialplanRepository;

    public function __construct(
        TrunksDialplanRepository $trunksDialplanRepository
    ) {
        $this->trunksDialplanRepository = $trunksDialplanRepository;
    }

    /**
     * @param TrunksDialplanInterface $entity
     */
    public function execute(TrunksDialplanInterface $entity)
    {
        $parentField = $entity->getParentReferenceField();

        if (is_null($parentField)) {
            return;
        }

        $getter =  "get".$parentField;
        $parentModel = $entity->getTransformationRulesetGroupsTrunk();
        $dpid = $parentModel->{$getter}();

        if (is_null($dpid)) {

            $maxDpiModels = $this->trunksDialplanRepository->findBy(
                [],
                ['dpid' => 'DESC'],
                1
            );

            /** @var TrunksDialplanInterface $maxDpiModel */
            $maxDpiModel = array_shift($maxDpiModels);

            $dpid = 1;
            if (!is_null($maxDpiModel)) {
                $dpid = $maxDpiModel->getDpid() + 1;
            }
        }

        $entity->setDpid($dpid);
    }
}