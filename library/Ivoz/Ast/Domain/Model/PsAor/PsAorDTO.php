<?php

namespace Ivoz\Ast\Domain\Model\PsAor;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class PsAorDTO implements DataTransferObjectInterface
{
    /**
     * @var integer
     */
    private $defaultExpiration;

    /**
     * @var integer
     */
    private $maxContacts;

    /**
     * @var integer
     */
    private $minimumExpiration;

    /**
     * @var string
     */
    private $removeExisting;

    /**
     * @var string
     */
    private $authenticateQualify;

    /**
     * @var integer
     */
    private $maximumExpiration;

    /**
     * @var string
     */
    private $supportPath;

    /**
     * @var string
     */
    private $contact;

    /**
     * @var integer
     */
    private $qualifyFrequency;

    /**
     * @var string
     */
    private $id;

    /**
     * @var mixed
     */
    private $psEndpointId;

    /**
     * @var mixed
     */
    private $psEndpoint;

    /**
     * @return array
     */
    public function __toArray()
    {
        return [
            'defaultExpiration' => $this->getDefaultExpiration(),
            'maxContacts' => $this->getMaxContacts(),
            'minimumExpiration' => $this->getMinimumExpiration(),
            'removeExisting' => $this->getRemoveExisting(),
            'authenticateQualify' => $this->getAuthenticateQualify(),
            'maximumExpiration' => $this->getMaximumExpiration(),
            'supportPath' => $this->getSupportPath(),
            'contact' => $this->getContact(),
            'qualifyFrequency' => $this->getQualifyFrequency(),
            'id' => $this->getId(),
            'psEndpointId' => $this->getPsEndpointId()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
        $this->psEndpoint = $transformer->transform('Ivoz\\Ast\\Domain\\Model\\PsEndpoint\\PsEndpoint', $this->getPsEndpointId());
    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {

    }

    /**
     * @param integer $defaultExpiration
     *
     * @return PsAorDTO
     */
    public function setDefaultExpiration($defaultExpiration = null)
    {
        $this->defaultExpiration = $defaultExpiration;

        return $this;
    }

    /**
     * @return integer
     */
    public function getDefaultExpiration()
    {
        return $this->defaultExpiration;
    }

    /**
     * @param integer $maxContacts
     *
     * @return PsAorDTO
     */
    public function setMaxContacts($maxContacts = null)
    {
        $this->maxContacts = $maxContacts;

        return $this;
    }

    /**
     * @return integer
     */
    public function getMaxContacts()
    {
        return $this->maxContacts;
    }

    /**
     * @param integer $minimumExpiration
     *
     * @return PsAorDTO
     */
    public function setMinimumExpiration($minimumExpiration = null)
    {
        $this->minimumExpiration = $minimumExpiration;

        return $this;
    }

    /**
     * @return integer
     */
    public function getMinimumExpiration()
    {
        return $this->minimumExpiration;
    }

    /**
     * @param string $removeExisting
     *
     * @return PsAorDTO
     */
    public function setRemoveExisting($removeExisting = null)
    {
        $this->removeExisting = $removeExisting;

        return $this;
    }

    /**
     * @return string
     */
    public function getRemoveExisting()
    {
        return $this->removeExisting;
    }

    /**
     * @param string $authenticateQualify
     *
     * @return PsAorDTO
     */
    public function setAuthenticateQualify($authenticateQualify = null)
    {
        $this->authenticateQualify = $authenticateQualify;

        return $this;
    }

    /**
     * @return string
     */
    public function getAuthenticateQualify()
    {
        return $this->authenticateQualify;
    }

    /**
     * @param integer $maximumExpiration
     *
     * @return PsAorDTO
     */
    public function setMaximumExpiration($maximumExpiration = null)
    {
        $this->maximumExpiration = $maximumExpiration;

        return $this;
    }

    /**
     * @return integer
     */
    public function getMaximumExpiration()
    {
        return $this->maximumExpiration;
    }

    /**
     * @param string $supportPath
     *
     * @return PsAorDTO
     */
    public function setSupportPath($supportPath = null)
    {
        $this->supportPath = $supportPath;

        return $this;
    }

    /**
     * @return string
     */
    public function getSupportPath()
    {
        return $this->supportPath;
    }

    /**
     * @param string $contact
     *
     * @return PsAorDTO
     */
    public function setContact($contact = null)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * @return string
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * @param integer $qualifyFrequency
     *
     * @return PsAorDTO
     */
    public function setQualifyFrequency($qualifyFrequency = null)
    {
        $this->qualifyFrequency = $qualifyFrequency;

        return $this;
    }

    /**
     * @return integer
     */
    public function getQualifyFrequency()
    {
        return $this->qualifyFrequency;
    }

    /**
     * @param string $id
     *
     * @return PsAorDTO
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param integer $psEndpointId
     *
     * @return PsAorDTO
     */
    public function setPsEndpointId($psEndpointId)
    {
        $this->psEndpointId = $psEndpointId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getPsEndpointId()
    {
        return $this->psEndpointId;
    }

    /**
     * @return \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpoint
     */
    public function getPsEndpoint()
    {
        return $this->psEndpoint;
    }
}


