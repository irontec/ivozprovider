<?php

namespace Ivoz\Provider\Domain\Model\CompanyRelCodec;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Codec\CodecInterface;

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

    public function setCompany(?CompanyInterface $company = null): static;

    public function getCompany(): ?CompanyInterface;

    public function getCodec(): CodecInterface;

    public function isInitialized(): bool;
}
