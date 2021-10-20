<?php

namespace Ivoz\Provider\Domain\Model\Recording;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Service\FileContainerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Core\Domain\Service\TempFile;

/**
* RecordingInterface
*/
interface RecordingInterface extends LoggableEntityInterface, FileContainerInterface
{
    public const TYPE_ONDEMAND = 'ondemand';

    public const TYPE_DDI = 'ddi';

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet(): array;

    /**
     * @return array
     */
    public function getFileObjects(?int $filter = null): array;

    public function getCallid(): ?string;

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getCalldate(): \DateTimeInterface;

    public function getType(): string;

    public function getDuration(): float;

    public function getCaller(): ?string;

    public function getCallee(): ?string;

    public function getRecorder(): ?string;

    public function getRecordedFile(): RecordedFile;

    public function setCompany(CompanyInterface $company): static;

    public function getCompany(): CompanyInterface;

    public function isInitialized(): bool;

    /**
     * @return void
     */
    public function addTmpFile(string $fldName, TempFile $file);

    /**
     * @throws \Exception
     * @return void
     */
    public function removeTmpFile(TempFile $file);

    /**
     * @return \Ivoz\Core\Domain\Service\TempFile[]
     */
    public function getTempFiles();

    /**
     * @var string $fldName
     * @return null | \Ivoz\Core\Domain\Service\TempFile
     */
    public function getTempFileByFieldName($fldName);
}
