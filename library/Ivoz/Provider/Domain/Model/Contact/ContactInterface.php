<?php

namespace Ivoz\Provider\Domain\Model\Contact;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface ContactInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Get lastname
     *
     * @return string | null
     */
    public function getLastname();

    /**
     * Get email
     *
     * @return string | null
     */
    public function getEmail();

    /**
     * Get workPhone
     *
     * @return string | null
     */
    public function getWorkPhone();

    /**
     * Get workPhoneE164
     *
     * @return string | null
     */
    public function getWorkPhoneE164();

    /**
     * Get mobilePhone
     *
     * @return string | null
     */
    public function getMobilePhone();

    /**
     * Get mobilePhoneE164
     *
     * @return string | null
     */
    public function getMobilePhoneE164();

    /**
     * Get otherPhone
     *
     * @return string | null
     */
    public function getOtherPhone();

    /**
     * Set user
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $user | null
     *
     * @return static
     */
    public function setUser(\Ivoz\Provider\Domain\Model\User\UserInterface $user = null);

    /**
     * Get user
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface | null
     */
    public function getUser();

    /**
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return static
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company);

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany();

    /**
     * Get workPhoneCountry
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface | null
     */
    public function getWorkPhoneCountry();

    /**
     * Get mobilePhoneCountry
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface | null
     */
    public function getMobilePhoneCountry();

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
