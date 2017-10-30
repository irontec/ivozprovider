<?php

namespace Ivoz\Provider\Domain\Model\Fax;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface FaxInterface extends LoggableEntityInterface
{
    public function getChangeSet();

    /**
     * {@inheritDoc}
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
     * Set sendByEmail
     *
     * @param boolean $sendByEmail
     *
     * @return self
     */
    public function setSendByEmail($sendByEmail);

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

