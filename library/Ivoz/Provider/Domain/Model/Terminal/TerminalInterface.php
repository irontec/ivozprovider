<?php

namespace Ivoz\Provider\Domain\Model\Terminal;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Doctrine\Common\Collections\Collection;

interface TerminalInterface extends LoggableEntityInterface
{
    /**
     * @return array
     */
    public function getChangeSet();

    /**
     * {@inheritDoc}
     */
    public function setName($name = null);

    /**
     * {@inheritDoc}
     */
    public function setPassword($password);

    public function getUser();

    /**
     * @return string
     */
    public function getContact();

    /**
     * @return string
     */
    public function getSorcery();

    /**
     * @return string
     */
    public function getAllow();

    /**
     * @return PsEndpointInterface
     */
    public function getAstPsEndpoint();

    public function setMac($mac = null);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Set disallow
     *
     * @param string $disallow
     *
     * @return self
     */
    public function setDisallow($disallow);

    /**
     * Get disallow
     *
     * @return string
     */
    public function getDisallow();

    /**
     * Set allowAudio
     *
     * @param string $allowAudio
     *
     * @return self
     */
    public function setAllowAudio($allowAudio);

    /**
     * Get allowAudio
     *
     * @return string
     */
    public function getAllowAudio();

    /**
     * Set allowVideo
     *
     * @param string $allowVideo
     *
     * @return self
     */
    public function setAllowVideo($allowVideo = null);

    /**
     * Get allowVideo
     *
     * @return string
     */
    public function getAllowVideo();

    /**
     * Set directMediaMethod
     *
     * @param string $directMediaMethod
     *
     * @return self
     */
    public function setDirectMediaMethod($directMediaMethod);

    /**
     * Get directMediaMethod
     *
     * @return string
     */
    public function getDirectMediaMethod();

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword();

    /**
     * Get mac
     *
     * @return string
     */
    public function getMac();

    /**
     * Set lastProvisionDate
     *
     * @param \DateTime $lastProvisionDate
     *
     * @return self
     */
    public function setLastProvisionDate($lastProvisionDate = null);

    /**
     * Get lastProvisionDate
     *
     * @return \DateTime
     */
    public function getLastProvisionDate();

    /**
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return self
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company = null);

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany();

    /**
     * Set domain
     *
     * @param \Ivoz\Provider\Domain\Model\Domain\DomainInterface $domain
     *
     * @return self
     */
    public function setDomain(\Ivoz\Provider\Domain\Model\Domain\DomainInterface $domain = null);

    /**
     * Get domain
     *
     * @return \Ivoz\Provider\Domain\Model\Domain\DomainInterface
     */
    public function getDomain();

    /**
     * Set terminalModel
     *
     * @param \Ivoz\Provider\Domain\Model\TerminalModel\TerminalModelInterface $terminalModel
     *
     * @return self
     */
    public function setTerminalModel(\Ivoz\Provider\Domain\Model\TerminalModel\TerminalModelInterface $terminalModel = null);

    /**
     * Get terminalModel
     *
     * @return \Ivoz\Provider\Domain\Model\TerminalModel\TerminalModelInterface
     */
    public function getTerminalModel();

    /**
     * Add astPsEndpoint
     *
     * @param \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface $astPsEndpoint
     *
     * @return TerminalTrait
     */
    public function addAstPsEndpoint(\Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface $astPsEndpoint);

    /**
     * Remove astPsEndpoint
     *
     * @param \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface $astPsEndpoint
     */
    public function removeAstPsEndpoint(\Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface $astPsEndpoint);

    /**
     * Replace astPsEndpoints
     *
     * @param \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface[] $astPsEndpoints
     * @return self
     */
    public function replaceAstPsEndpoints(Collection $astPsEndpoints);

    /**
     * Get astPsEndpoints
     *
     * @return \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface[]
     */
    public function getAstPsEndpoints(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add user
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $user
     *
     * @return TerminalTrait
     */
    public function addUser(\Ivoz\Provider\Domain\Model\User\UserInterface $user);

    /**
     * Remove user
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $user
     */
    public function removeUser(\Ivoz\Provider\Domain\Model\User\UserInterface $user);

    /**
     * Replace users
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface[] $users
     * @return self
     */
    public function replaceUsers(Collection $users);

    /**
     * Get users
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface[]
     */
    public function getUsers(\Doctrine\Common\Collections\Criteria $criteria = null);

}

