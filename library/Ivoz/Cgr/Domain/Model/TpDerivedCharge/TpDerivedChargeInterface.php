<?php

namespace Ivoz\Cgr\Domain\Model\TpDerivedCharge;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface TpDerivedChargeInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Set tpid
     *
     * @param string $tpid
     *
     * @return self
     */
    public function setTpid($tpid);

    /**
     * Get tpid
     *
     * @return string
     */
    public function getTpid();

    /**
     * Set loadid
     *
     * @param string $loadid
     *
     * @return self
     */
    public function setLoadid($loadid);

    /**
     * Get loadid
     *
     * @return string
     */
    public function getLoadid();

    /**
     * Set direction
     *
     * @param string $direction
     *
     * @return self
     */
    public function setDirection($direction);

    /**
     * Get direction
     *
     * @return string
     */
    public function getDirection();

    /**
     * Set tenant
     *
     * @param string $tenant
     *
     * @return self
     */
    public function setTenant($tenant);

    /**
     * Get tenant
     *
     * @return string
     */
    public function getTenant();

    /**
     * Set category
     *
     * @param string $category
     *
     * @return self
     */
    public function setCategory($category);

    /**
     * Get category
     *
     * @return string
     */
    public function getCategory();

    /**
     * Set account
     *
     * @param string $account
     *
     * @return self
     */
    public function setAccount($account);

    /**
     * Get account
     *
     * @return string
     */
    public function getAccount();

    /**
     * Set subject
     *
     * @param string $subject
     *
     * @return self
     */
    public function setSubject($subject = null);

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject();

    /**
     * Set runid
     *
     * @param string $runid
     *
     * @return self
     */
    public function setRunid($runid);

    /**
     * Get runid
     *
     * @return string
     */
    public function getRunid();

    /**
     * Set runFilters
     *
     * @param string $runFilters
     *
     * @return self
     */
    public function setRunFilters($runFilters);

    /**
     * Get runFilters
     *
     * @return string
     */
    public function getRunFilters();

    /**
     * Set accountField
     *
     * @param string $accountField
     *
     * @return self
     */
    public function setAccountField($accountField);

    /**
     * Get accountField
     *
     * @return string
     */
    public function getAccountField();

    /**
     * Set subjectField
     *
     * @param string $subjectField
     *
     * @return self
     */
    public function setSubjectField($subjectField);

    /**
     * Get subjectField
     *
     * @return string
     */
    public function getSubjectField();

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return self
     */
    public function setCreatedAt($createdAt);

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand
     *
     * @return self
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand);

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    public function getBrand();

}

