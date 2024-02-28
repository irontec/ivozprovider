<?php

namespace Ivoz\Provider\Domain\Model\FaxesInOut;

use Assert\Assertion;
use Ivoz\Core\Domain\Model\TempFileContainnerTrait;
use Ivoz\Core\Domain\Service\FileContainerInterface;

/**
 * FaxesInOut
 */
class FaxesInOut extends FaxesInOutAbstract implements FileContainerInterface, FaxesInOutInterface
{
    use FaxesInOutTrait;
    use TempFileContainnerTrait;

    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
     */
    public function getChangeSet(): array
    {
        return parent::getChangeSet();
    }

    /**
     * {@inheritDoc}
     */
    protected function sanitizeValues(): void
    {
        if (!$this->getStatus()) {
            $this->setStatus(self::STATUS_PENDING);
        }
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
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getDstE164()
    {
        if (!$this->getDstCountry()) {
            return "";
        }

        return
            $this->getDstCountry()->getCountryCode() .
            $this->getDst();
    }

    protected function setDst(?string $dst = null): static
    {
        $dst = str_replace(['+', ' '], '', $dst);
        Assertion::regex($dst, '/^[0-9]+$/');
        return parent::setDst($dst);
    }
}
