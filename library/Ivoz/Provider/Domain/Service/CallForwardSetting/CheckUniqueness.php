<?php

namespace Ivoz\Provider\Domain\Service\CallForwardSetting;

use Doctrine\Common\Collections\Criteria;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\Model\Helper\CriteriaHelper;
use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSetting;
use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingInterface;
use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingRepository;

/**
 * Class CheckValidity
 * @package Ivoz\Provider\Domain\Service\CallForwardSetting
 * @lifecycle pre_persist
 */
class CheckUniqueness implements CallForwardSettingLifecycleEventHandlerInterface
{
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
     *
     * @return void
     */
    public function execute(CallForwardSettingInterface $entity)
    {
        // Skip checks for disabled call forward setting
        if ($entity->getEnabled() == 0) {
            return;
        }

        $callTypeFilterConditions = array(
            $entity->getCallTypeFilter()
        );

        if ($entity->getCallTypeFilter() === CallForwardSettingInterface::CALLTYPEFILTER_BOTH) {
            $callTypeFilterConditions[] = CallForwardSettingInterface::CALLTYPEFILTER_EXTERNAL;
            $callTypeFilterConditions[] = CallForwardSettingInterface::CALLTYPEFILTER_INTERNAL;
        } else {
            $callTypeFilterConditions[] = CallForwardSettingInterface::CALLTYPEFILTER_BOTH;
        }

        $isInconditional = ($entity->getCallForwardType() === CallForwardSettingInterface::CALLFORWARDTYPE_INCONDITIONAL);
        if ($isInconditional) {
            $inconditionalCallForwardsConditions = $this->getInconditionalCallForwardsCondition(
                $entity,
                $callTypeFilterConditions
            );
            $callForwards = $this->callForwardSettingRepository->matching(
                $inconditionalCallForwardsConditions
            );

            if ($callForwards->count() > 0) {
                $message = "There is already a inconditional call forward with that call type.";
                throw new \DomainException($message, self::CALL_FORWARDS_WITH_THAT_TYPE_EXCEPTION);
            }
        }

        $isBusy = ($entity->getCallForwardType() === CallForwardSettingInterface::CALLFORWARDTYPE_BUSY);
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

        $isNoAnswer = ($entity->getCallForwardType() === CallForwardSettingInterface::CALLFORWARDTYPE_NOANSWER);
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

        $isUserNotRegistered = ($entity->getCallForwardType() === CallForwardSettingInterface::CALLFORWARDTYPE_USERNOTREGISTERED);
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
     * @param CallForwardSettingInterface $entity
     * @param array $callTypeFilterConditions
     * @return Criteria
     */
    protected function getInconditionalCallForwardsCondition(CallForwardSettingInterface $entity, $callTypeFilterConditions)
    {
        return $this->createConditions(
            $entity,
            $callTypeFilterConditions,
            'inconditional'
        );
    }

    /**
     * @param CallForwardSettingInterface $entity
     * @param array $callTypeFilterConditions
     * @return Criteria
     */
    protected function getCallForwardsCondition(CallForwardSettingInterface $entity, $callTypeFilterConditions)
    {
        return $this->createConditions(
            $entity,
            $callTypeFilterConditions
        );
    }

    /**
     * @param CallForwardSettingInterface $entity
     * @param array $callTypeFilterConditions
     * @return Criteria
     */
    protected function getBusyCallForwardsConditions(CallForwardSettingInterface $entity, $callTypeFilterConditions)
    {
        return $this->createConditions(
            $entity,
            $callTypeFilterConditions,
            'busy'
        );
    }

    /**
     * @param CallForwardSettingInterface $entity
     * @param array $callTypeFilterConditions
     * @return Criteria
     */
    protected function getNoAnswerCallForwardsConditions(CallForwardSettingInterface $entity, $callTypeFilterConditions)
    {
        return $this->createConditions(
            $entity,
            $callTypeFilterConditions,
            'noAnswer'
        );
    }

    /**
     * @param CallForwardSettingInterface $entity
     * @param array $callTypeFilterConditions
     * @return Criteria
     */
    protected function getUserNotRegisteredCallForwardsConditions(CallForwardSettingInterface $entity, $callTypeFilterConditions)
    {
        return $this->createConditions(
            $entity,
            $callTypeFilterConditions,
            'userNotRegistered'
        );
    }

    /**
     * @param CallForwardSettingInterface $entity
     * @param array $callTypeFilterConditions
     * @param string | null $callForwardType
     * @return Criteria
     */
    protected function createConditions(CallForwardSettingInterface $entity, $callTypeFilterConditions, $callForwardType = null)
    {
        $criteria = [
            ['id', 'neq', $entity->getId()],
            ['callTypeFilter', 'in', $callTypeFilterConditions],
            ['enabled', 'eq', 1]
        ];

        if (!is_null($entity->getUser())) {
            $criteria[] = ['user', 'eq', $entity->getUser()];
        } elseif (!is_null($entity->getResidentialDevice())) {
            $criteria[] = ['residentialDevice', 'eq', $entity->getResidentialDevice()];
        } elseif (!is_null($entity->getRetailAccount())) {
            $criteria[] = ['retailAccount', 'eq', $entity->getRetailAccount()];
        }

        if ($callForwardType) {
            $criteria[] = [
                'callForwardType', 'eq', $callForwardType
            ];
        }

        $ddi = $entity->getDdi();

        if ($ddi) {
            $criteria[] = ['ddi', 'eq', $ddi];
        }

        return CriteriaHelper::fromArray($criteria);
    }
}
