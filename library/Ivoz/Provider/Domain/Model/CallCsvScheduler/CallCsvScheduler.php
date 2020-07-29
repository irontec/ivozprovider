<?php

namespace Ivoz\Provider\Domain\Model\CallCsvScheduler;

use Ivoz\Core\Domain\Model\SchedulerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

/**
 * CallCsvScheduler
 */
class CallCsvScheduler extends CallCsvSchedulerAbstract implements SchedulerInterface, CallCsvSchedulerInterface
{
    use CallCsvSchedulerTrait {
        toDto as protected traitToDto;
    }

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

    protected function sanitizeValues()
    {
        $company = $this->getCompany();
        $brand = $this->getBrand();
        if (is_null($brand) && is_null($company)) {
            throw new \DomainException('Either company or brand must have a value');
        }

        if (is_null($company)) {
            $this
                ->setRetailAccount(null)
                ->setResidentialDevice(null)
                ->setUser(null)
                ->setFax(null)
                ->setDdi(null)
                ->setFriend(null);
        } else {
            $this
                ->setCallCsvNotificationTemplate(null);

            $company = $this->getCompany();

            switch ($company->getType()) {
                case CompanyInterface::TYPE_RESIDENTIAL:
                    $this
                        ->setRetailAccount(null)
                        ->setUser(null)
                        ->setFriend(null);
                    break;
                case CompanyInterface::TYPE_RETAIL:
                    $this
                        ->setResidentialDevice(null)
                        ->setUser(null)
                        ->setFax(null)
                        ->setFriend(null);
                    break;
                case CompanyInterface::TYPE_WHOLESALE:
                    $this
                        ->setRetailAccount(null)
                        ->setResidentialDevice(null)
                        ->setUser(null)
                        ->setFax(null)
                        ->setFriend(null)
                        ->setDdi(null);

                    break;
                case CompanyInterface::TYPE_VPBX:
                    $this
                        ->setResidentialDevice(null)
                        ->setRetailAccount(null);

                    if ($this->getUser()) {
                        $this
                            ->setFax(null)
                            ->setFriend(null);
                    } elseif ($this->getFax()) {
                        $this
                            ->setUser(null)
                            ->setFriend(null);
                    } elseif ($this->getFriend()) {
                        $this
                            ->setUser(null)
                            ->setFax(null);
                    } else {
                        $this
                            ->setUser(null)
                            ->setFax(null)
                            ->setFriend(null);
                    }
                    break;
            }
        }

        $isNotOutbound = $this->getCallDirection() !== self::CALLDIRECTION_OUTBOUND;
        if ($isNotOutbound) {
            if ($this->getCarrier()) {
                throw new \DomainException('Filter by carrier is only possible for outbound calls');
            }
        } else {
            if ($this->getDdiProvider()) {
                throw new \DomainException('Filter by ddi provider is only possible for inbound calls');
            }
        }
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface
     */
    public function getTimezone()
    {
        $timeZone = $this->getCompany()
            ? $this->getCompany()->getDefaultTimezone()
            : $this->getBrand()->getDefaultTimezone();

        return $timeZone;
    }

    public function getSchedulerDateTimeZone(): \DateTimeZone
    {
        $timezone = $this->getTimezone();

        return new \DateTimeZone(
            $timezone->getTz()
        );
    }

    /**
     * @return \DateInterval
     */
    public function getInterval()
    {
        $frecuency = $this->getFrequency();

        switch ($this->getUnit()) {
            /** @see http://php.net/manual/es/dateinterval.createfromdatestring.php */
            case 'month':
                return new \DateInterval("P${frecuency}M");
            case 'week':
                return new \DateInterval("P${frecuency}W");
            case 'day':
                return \DateInterval::createFromDateString('1 day');
        }
    }


    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return CallCsvSchedulerDto
     */
    public function toDto($depth = 0)
    {
        $dto = $this->traitToDto($depth);
        $companyDto = \Ivoz\Provider\Domain\Model\Company\Company::entityToDto(
            self::getCompany(),
            1
        );

        $dto->setCompany($companyDto);

        return $dto;
    }

    protected function setLastExecutionError($lastExecutionError = null)
    {
        if (!is_null($lastExecutionError)) {
            $lastExecutionError = substr(
                $lastExecutionError,
                0,
                300
            );
        }

        return parent::setLastExecutionError($lastExecutionError);
    }
}
