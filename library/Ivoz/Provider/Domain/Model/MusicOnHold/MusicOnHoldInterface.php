<?php

namespace Ivoz\Provider\Domain\Model\MusicOnHold;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Service\FileContainerInterface;
use Ivoz\Core\Domain\Service\TempFile;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

/**
* MusicOnHoldInterface
*/
interface MusicOnHoldInterface extends LoggableEntityInterface, FileContainerInterface
{
    public const STATUS_PENDING = 'pending';

    public const STATUS_ENCODING = 'encoding';

    public const STATUS_READY = 'ready';

    public const STATUS_ERROR = 'error';

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet(): array;

    /**
     * @return array
     */
    public function getFileObjects(?int $filter = null): array;

    /**
     * @return string
     */
    public function getOwner();

    /**
     * Add TempFile and set status to pending
     *
     * @param string $fldName
     * @param \Ivoz\Core\Domain\Service\TempFile $file
     */
    public function addTmpFile(string $fldName, TempFile $file);

    public function getName(): string;

    public function getStatus(): ?string;

    public function getOriginalFile(): OriginalFile;

    public function getEncodedFile(): EncodedFile;

    public function setBrand(?BrandInterface $brand = null): static;

    public function getBrand(): ?BrandInterface;

    public function setCompany(?CompanyInterface $company = null): static;

    public function getCompany(): ?CompanyInterface;

    public function isInitialized(): bool;

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
