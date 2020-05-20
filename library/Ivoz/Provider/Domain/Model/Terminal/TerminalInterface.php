<?php

namespace Ivoz\Provider\Domain\Model\Terminal;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\ArrayCollection;

interface TerminalInterface extends LoggableEntityInterface
{
    const DIRECTMEDIAMETHOD_UPDATE = 'update';
    const DIRECTMEDIAMETHOD_INVITE = 'invite';
    const DIRECTMEDIAMETHOD_REINVITE = 'reinvite';


    const T38PASSTHROUGH_YES = 'yes';
    const T38PASSTHROUGH_NO = 'no';


    /**
     * @return array
     */
    public function getChangeSet();

    /**
     * {@inheritDoc}
     * @throws \InvalidArgumentException
     */
    public function setName($name = null);

    /**
     * {@inheritDoc}
     * @throws \InvalidArgumentException
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
     * @return \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface | null
     */
    public function getAstPsEndpoint();

    public function setMac($mac = null);

    /**
     * Get name
     *
     * @return string | null
     */
    public function getName();

    /**
     * Get disallow
     *
     * @return string
     */
    public function getDisallow();

    /**
     * Get allowAudio
     *
     * @return string
     */
    public function getAllowAudio();

    /**
     * Get allowVideo
     *
     * @return string | null
     */
    public function getAllowVideo();

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
     * @return string | null
     */
    public function getMac();

    /**
     * Get lastProvisionDate
     *
     * @return \DateTime | null
     */
    public function getLastProvisionDate();

    /**
     * Get t38Passthrough
     *
     * @return string
     */
    public function getT38Passthrough();

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
     * Set domain
     *
     * @param \Ivoz\Provider\Domain\Model\Domain\DomainInterface $domain | null
     *
     * @return static
     */
    public function setDomain(\Ivoz\Provider\Domain\Model\Domain\DomainInterface $domain = null);

    /**
     * Get domain
     *
     * @return \Ivoz\Provider\Domain\Model\Domain\DomainInterface | null
     */
    public function getDomain();

    /**
     * Get terminalModel
     *
     * @return \Ivoz\Provider\Domain\Model\TerminalModel\TerminalModelInterface | null
     */
    public function getTerminalModel();

    /**
     * Add astPsEndpoint
     *
     * @param \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface $astPsEndpoint
     *
     * @return static
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
     * @param ArrayCollection $astPsEndpoints of Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface
     * @return static
     */
    public function replaceAstPsEndpoints(ArrayCollection $astPsEndpoints);

    /**
     * Get astPsEndpoints
     * @param Criteria | null $criteria
     * @return \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface[]
     */
    public function getAstPsEndpoints(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add user
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $user
     *
     * @return static
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
     * @param ArrayCollection $users of Ivoz\Provider\Domain\Model\User\UserInterface
     * @return static
     */
    public function replaceUsers(ArrayCollection $users);

    /**
     * Get users
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface[]
     */
    public function getUsers(\Doctrine\Common\Collections\Criteria $criteria = null);
}
