<?php

namespace Ivoz\Provider\Domain\Model\CallCsvScheduler;

use Ivoz\Core\Domain\Model\SchedulerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface;

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
     * @return array<string, mixed>
     */
    public function getChangeSet(): array
    {
        return parent::getChangeSet();
    }

    protected function sanitizeValues(): void
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
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTimezone(): ?TimezoneInterface
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
    public function getInterval(): \DateInterval
    {
        $frecuency = $this->getFrequency();

        switch ($this->getUnit()) {
            /** @see http://php.net/manual/es/dateinterval.createfromdatestring.php */
            case CallCsvSchedulerInterface::UNIT_MONTH:
                return new \DateInterval("P${frecuency}M");
            case CallCsvSchedulerInterface::UNIT_WEEK:
                return new \DateInterval("P${frecuency}W");
            default:
                return new \DateInterval("P${frecuency}D");
        }
    }


    /**
     * @internal use EntityTools instead
     * @return CallCsvSchedulerDto
     */
    public function toDto(int $depth = 0): CallCsvSchedulerDto
    {
        $dto = $this->traitToDto($depth);
        $companyDto = \Ivoz\Provider\Domain\Model\Company\Company::entityToDto(
            self::getCompany(),
            1
        );

        $dto->setCompany($companyDto);

        return $dto;
    }

    protected function setLastExecutionError(?string $lastExecutionError = null): static
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
