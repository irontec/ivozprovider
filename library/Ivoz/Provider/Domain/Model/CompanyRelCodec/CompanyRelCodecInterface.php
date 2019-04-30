<?php

namespace Ivoz\Provider\Domain\Model\CompanyRelCodec;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

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
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return static
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company = null);

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany();

    /**
     * Set codec
     *
     * @param \Ivoz\Provider\Domain\Model\Codec\CodecInterface $codec
     *
     * @return static
     */
    public function setCodec(\Ivoz\Provider\Domain\Model\Codec\CodecInterface $codec);

    /**
     * Get codec
     *
     * @return \Ivoz\Provider\Domain\Model\Codec\CodecInterface
     */
    public function getCodec();
}
