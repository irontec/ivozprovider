<?php

namespace Ivoz\Provider\Domain\Model\Fax;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface FaxInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Return string representation of this entity
     * @return string
     */
    public function __toString();

    public function setSendByEmail($sendByEmail);

    /**
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface
     */
    public function getOutgoingDdi();

    /**
     * Set name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName($name);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Set email
     *
     * @param string $email
     *
     * @return self
     */
    public function setEmail($email = null);

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail();

    /**
     * Get sendByEmail
     *
     * @return boolean
     */
    public function getSendByEmail();

    /**
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return self
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company);

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany();

    /**
     * Set outgoingDdi
     *
     * @param \Ivoz\Provider\Domain\Model\Ddi\DdiInterface $outgoingDdi
     *
     * @return self
     */
    public function setOutgoingDdi(\Ivoz\Provider\Domain\Model\Ddi\DdiInterface $outgoingDdi = null);

}

