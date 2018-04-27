<?php

namespace Ivoz\Provider\Domain\Service\CallForwardSetting;

use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingInterface;
use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingRepository;
use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSetting;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\Model\Helper\CriteriaHelper;

/**
 * Class CheckValidity
 * @package Ivoz\Provider\Domain\Service\CallForwardSetting
 * @lifecycle pre_persist
 */
class CheckUniqueness implements CallForwardSettingLifecycleEventHandlerInterface
{
    const INCONDITIONAL_CALL_FORWARD_EXCEPTION = 30000;
    const CALL_FORWARDS_WITH_THAT_TYPE_EXCEPTION = 30001;
    const BUSY_CALL_FORWARD_EXCEPTION = 30002;
    const NO_ANSWER_CALL_FORWARD_EXCEPTION = 30003;
    const USER_NOT_REGISTERED_CALL_FORWARD_EXCEPTION = 30004;

    /**
     * @var CallForwardSettingRepository
     */
    protected $callForwardSettingRepository;

    public function __construct(CallForwardSettingRepository $callForwardSettingRepository)
    {
        $this->callForwardSettingRepository = $callForwardSettingRepository;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_PERSIST => 10
        ];
    }

    /**
     * @throws \Exception
     */
    public function execute(CallForwardSettingInterface $entity, $isNew)
    {
        // Skip checks for disabled call forward setting
        if ($entity->getEnabled() == 0) {
            return;
        }

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
            throw new \DomainException($message, self::INCONDITIONAL_CALL_FORWARD_EXCEPTION);
        }

        $isInconditional = ($entity->getCallForwardType() === 'inconditional');
        if ($isInconditional) {
            $callForwardsConditions = $this->getCallForwardsCondition(
                $entity,
                $callTypeFilterConditions
            );
            $callForwards = $this->callForwardSettingRepository->matching(
                $callForwardsConditions
            );

            if ($callForwards->count() > 0) {
                $message = "There are already call forwards with that call type. You can't add inconditional call forward";
                throw new \DomainException($message, self::CALL_FORWARDS_WITH_THAT_TYPE_EXCEPTION);
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
                throw new \DomainException($message, self::BUSY_CALL_FORWARD_EXCEPTION);
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
                throw new \DomainException($message, self::NO_ANSWER_CALL_FORWARD_EXCEPTION);
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
                throw new \DomainException($message, self::USER_NOT_REGISTERED_CALL_FORWARD_EXCEPTION);
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
    protected function createConditions(CallForwardSetting $entity, $callTypeFilterConditions, $callForwardType = null)
    {

        $criteria = [
            ['id', 'neq', $entity->getId()],
            ['user', 'eq', $entity->getUser()],
            ['callTypeFilter', 'in', $callTypeFilterConditions],
            ['enabled', 'eq', 1]
        ];

        if ($callForwardType) {
            $criteria[] = [
                'callForwardType', 'eq', $callForwardType
            ];
        }

        return CriteriaHelper::fromArray($criteria);
    }
}