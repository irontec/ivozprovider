<?php

namespace Ivoz\Provider\Domain\Model\CompanyRelCodec;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Codec\CodecInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* CompanyRelCodecInterface
*/
interface CompanyRelCodecInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Set company
     *
     * @param CompanyInterface | null
     *
     * @return static
     */
    public function setCompany(?CompanyInterface $company = null): CompanyRelCodecInterface;

    /**
     * Get company
     *
     * @return CompanyInterface | null
     */
    public function getCompany(): ?CompanyInterface;

    /**
     * Get codec
     *
     * @return CodecInterface
     */
    public function getCodec(): CodecInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
