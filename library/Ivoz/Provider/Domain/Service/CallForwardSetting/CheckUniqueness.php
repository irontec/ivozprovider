<?php

namespace Ivoz\Provider\Domain\Service\CallForwardSetting;

use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingInterface;
use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingRepository;
use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSetting;
use Doctrine\Common\Collections\Criteria;

/**
 * Class CheckValidity
 * @package Ivoz\Provider\Domain\Service\CallForwardSetting
 * @lifecycle pre_persist
 */
class CheckUniqueness implements CallForwardSettingLifecycleEventHandlerInterface
{
    /**
     * @var CallForwardSettingRepository
     */
    protected $callForwardSettingRepository;

    public function __construct(CallForwardSettingRepository $callForwardSettingRepository)
    {
        $this->callForwardSettingRepository = $callForwardSettingRepository;
    }

    /**
     * @throws \Exception
     */
    public function execute(CallForwardSettingInterface $entity, $isNew)
    {
        $callTypeFilterConditions = array(
            $entity->getCallTypeFilter()
        );

        if ($entity->getCallTypeFilter() == 'both') {
            $callTypeFilterConditions[] = 'external';
            $callTypeFilterConditions[] = 'internal';
        } else {
            $callTypeFilterConditions[] = 'both';
        }

        $inconditionalCallForwardsConditions = $this->getInconditionalCallForwardsCondition(
            $entity,
            $callTypeFilterConditions
        );
        $inconditionalCallForwards = $this->callForwardSettingRepository->matching(
            $inconditionalCallForwardsConditions
        );

        if ($inconditionalCallForwards->count() > 0) {
            $message = "There is an inconditional call forward with that call type. You can't add call forwards";
            throw new \Exception($message, 30000);
        }

        $isInconditional = ($entity->getCallForwardType() === 'inconditional');
        if ($isInconditional) {
            //@todo this looks like duplicated code
            $callForwardsConditions = $this->getCallForwardsCondition(
                $entity,
                $callTypeFilterConditions
            );
            $callForwards = $this->callForwardSettingRepository->matching(
                $callForwardsConditions
            );

            if ($callForwards->count() > 0) {
                $message = "There are already call forwards with that call type. You can't add inconditional call forward";
                throw new \Exception($message, 30001);
            }
        }

        $isBusy = ($entity->getCallForwardType() === 'busy');
        if ($isBusy) {
            $busyCallForwardsConditions = $this->getBusyCallForwardsConditions(
                $entity,
                $callTypeFilterConditions
            );
            $busyCallForwards = $this->callForwardSettingRepository->matching(
                $busyCallForwardsConditions
            );

            if ($busyCallForwards->count() > 0) {
                $message = "There is already a busy call forward with that call type.";
                throw new \Exception($message, 30002);
            }
        }

        $isNoAnswer = ($entity->getCallForwardType() === 'noAnswer');
        if ($isNoAnswer) {
            $noAnswerCallForwardsConditions = $this->getNoAnswerCallForwardsConditions(
                $entity,
                $callTypeFilterConditions
            );
            $noAnswerCallForwards = $this->callForwardSettingRepository->matching(
                $noAnswerCallForwardsConditions
            );

            if ($noAnswerCallForwards->count() > 0) {
                $message = "There is already a noAnswer call forward with that call type.";
                throw new \Exception($message, 30003);
            }
        }

        $isUserNotRegistered = ($entity->getCallForwardType() == "userNotRegistered");
        if ($isUserNotRegistered) {
            $userNotRegisteredCallForwardsConditions = $this->getUserNotRegisteredCallForwardsConditions(
                $entity,
                $callTypeFilterConditions
            );
            $userNotRegisteredCallForwards = $this->callForwardSettingRepository->matching(
                $userNotRegisteredCallForwardsConditions
            );

            if ($userNotRegisteredCallForwards->count() > 0) {
                $message = "There is already a userNotRegistered call forward with that call type.";
                throw new \Exception($message, 30004);
            }
        }
    }

    /**
     * @param CallForwardSetting $entity
     * @param $callTypeFilterConditions
     * @return Criteria
     */
    protected function getInconditionalCallForwardsCondition(CallForwardSetting $entity, $callTypeFilterConditions)
    {
        return $this->createConditions(
            $entity,
            $callTypeFilterConditions,
            'inconditional'
        );
    }

    /**
     * @param CallForwardSetting $entity
     * @param $callTypeFilterConditions
     * @return Criteria
     */
    protected function getCallForwardsCondition(CallForwardSetting $entity, $callTypeFilterConditions)
    {
        return $this->createConditions(
            $entity,
            $callTypeFilterConditions
        );
    }

    /**
     * @param CallForwardSetting $entity
     * @param $callTypeFilterConditions
     * @return Criteria
     */
    protected function getBusyCallForwardsConditions(CallForwardSetting $entity, $callTypeFilterConditions)
    {
        return $this->createConditions(
            $entity,
            $callTypeFilterConditions,
            'busy'
        );
    }

    /**
     * @param CallForwardSetting $entity
     * @param $callTypeFilterConditions
     * @return Criteria
     */
    protected function getNoAnswerCallForwardsConditions(CallForwardSetting $entity, $callTypeFilterConditions)
    {
        return $this->createConditions(
            $entity,
            $callTypeFilterConditions,
            'noAnswer'
        );
    }

    /**
     * @param CallForwardSetting $entity
     * @param $callTypeFilterConditions
     * @return Criteria
     */
    protected function getUserNotRegisteredCallForwardsConditions(CallForwardSetting $entity, $callTypeFilterConditions)
    {
        return $this->createConditions(
            $entity,
            $callTypeFilterConditions,
            'userNotRegistered'
        );

        return $criteria;
    }

    /**
     * @param CallForwardSetting $entity
     * @param $callTypeFilterConditions
     * @param $callForwardType
     * @return Criteria
     */
    protected function createConditions(CallForwardSetting $entity, $callTypeFilterConditions, $callForwardType)
    {
        $criteria = Criteria::create();
        $expressionBuilder = Criteria::expr();

        $criteria
            ->where(
                $expressionBuilder->neq(
                    'id',
                    $entity->getId()
                )
            )
            ->andWhere(
                $expressionBuilder->eq(
                    'user',
                    $entity->getUser()
                )
            )
            ->andWhere(
                $expressionBuilder->in(
                    'callTypeFilter',
                    $callTypeFilterConditions
                )
            )
            ->andWhere(
                $expressionBuilder->eq(
                    'callForwardType',
                    $callForwardType
                )
            );

        return $criteria;
    }
}