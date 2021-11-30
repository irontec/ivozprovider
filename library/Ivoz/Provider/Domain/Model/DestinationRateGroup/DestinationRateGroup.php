<?php

namespace Ivoz\Provider\Domain\Model\DestinationRateGroup;

use Ivoz\Core\Domain\Model\TempFileContainnerTrait;
use Ivoz\Core\Domain\Service\FileContainerInterface;
use Ivoz\Core\Domain\Service\TempFile;
use Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRateInterface;

/**
 * DestinationRateGroup
 */
class DestinationRateGroup extends DestinationRateGroupAbstract implements FileContainerInterface, DestinationRateGroupInterface
{
    public const READONLY_DEDUCTIBLECONNECTIONFEE_EXCEPTION = 2301;

    use DestinationRateGroupTrait;

    use TempFileContainnerTrait {
        addTmpFile as protected _addTmpFile;
    }

    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
     */
    public function getChangeSet(): array
    {
        return parent::getChangeSet();
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

    /**
     * @return array
     */
    public function getFileObjects(int $filter = null): array
    {
        $fileObjects = [
            'file' => [
                FileContainerInterface::DOWNLOADABLE_FILE,
                FileContainerInterface::UPDALOADABLE_FILE,
            ]
        ];

        return $this->filterFileObjects(
            $fileObjects,
            $filter
        );
    }

    /**
     * Add TempFile and set status to pending
     *
     * @param string $fldName
     * @param \Ivoz\Core\Domain\Service\TempFile $file
     *
     * @return void
     */
    public function addTmpFile(string $fldName, TempFile $file)
    {
        if ($fldName === 'file') {
            $this->setStatus('waiting');
        }
        $this->_addTmpFile($fldName, $file);
    }

    /**
     * @return string
     */
    public function getCgrTag(): string
    {
        return sprintf(
            "b%ddr%d",
            (int) $this->getBrand()->getId(),
            (int) $this->getId()
        );
    }

    /**
     * @return string
     */
    public function getCurrencySymbol(): string
    {
        $currency = $this->getCurrency();
        if (!$currency) {
            return $this->getBrand()->getCurrencySymbol();
        }
        return $currency->getSymbol();
    }

    /**
     * @return string
     */
    public function getCurrencyIden(): string
    {
        $currency = $this->getCurrency();
        if (!$currency) {
            return $this->getBrand()->getCurrencyIden();
        }
        return $currency->getIden();
    }

    /**
     * @return string
     */
    public function getRoundingMethod()
    {
        return $this->getDeductibleConnectionFee() ?
            TpDestinationRateInterface::ROUNDINGMETHOD_UPMINCOST :
            TpDestinationRateInterface::ROUNDINGMETHOD_UP;
    }

    protected function sanitizeValues(): void
    {
        if (!$this->isNew() && $this->hasChanged('deductibleConnectionFee')) {
            throw new \DomainException(
                "Deductible Connection Fee cannot be changed",
                self::READONLY_DEDUCTIBLECONNECTIONFEE_EXCEPTION
            );
        }
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
