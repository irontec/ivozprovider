<?php

namespace Ivoz\Provider\Domain\Model\FaxesInOut;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Service\FileContainerInterface;
use Ivoz\Provider\Domain\Model\Fax\FaxInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Core\Domain\Service\TempFile;

/**
* FaxesInOutInterface
*/
interface FaxesInOutInterface extends LoggableEntityInterface, FileContainerInterface
{
    const TYPE_IN = 'In';

    const TYPE_OUT = 'Out';

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * @return array
     */
    public function getFileObjects(?int $filter = null);

    public function setCalldate($calldate = null): static;

    /**
     * Get the numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getDstE164();

    public function getCalldate(): \DateTime;

    public function getSrc(): ?string;

    public function getDst(): ?string;

    public function getType(): ?string;

    public function getPages(): ?string;

    public function getStatus(): ?string;

    public function getFile(): File;

    public function getFax(): FaxInterface;

    public function getDstCountry(): ?CountryInterface;

    /**
     * @return bool
     */
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
