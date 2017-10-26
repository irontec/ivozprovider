<?php

namespace Ivoz\Ast\Domain\Model\PsAor;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * PsAorAbstract
 * @codeCoverageIgnore
 */
abstract class PsAorAbstract
{
    /**
     * @column default_expiration
     * @var integer
     */
    protected $defaultExpiration;

    /**
     * @column max_contacts
     * @var integer
     */
    protected $maxContacts;

    /**
     * @column minimum_expiration
     * @var integer
     */
    protected $minimumExpiration;

    /**
     * @column remove_existing
     * @var string
     */
    protected $removeExisting;

    /**
     * @column authenticate_qualify
     * @var string
     */
    protected $authenticateQualify;

    /**
     * @column maximum_expiration
     * @var integer
     */
    protected $maximumExpiration;

    /**
     * @column support_path
     * @var string
     */
    protected $supportPath;

    /**
     * @var string
     */
    protected $contact;

    /**
     * @column qualify_frequency
     * @var integer
     */
    protected $qualifyFrequency;

    /**
     * @var \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface
     */
    protected $psEndpoint;


    /**
     * Changelog tracking purpose
     * @var array
     */
    protected $_initialValues = [];

    /**
     * Constructor
     */
    public function __construct()
    {


        $this->initChangelog();
    }

    /**
     * @param string $fieldName
     * @return mixed
     * @throws \Exception
     */
    public function initChangelog()
    {
        $values = $this->__toArray();
        if (!$this->getId()) {
            // Empty values for entities with no Id
            foreach ($values as $key => $val) {
                $values[$key] = null;
            }
        }

        $this->_initialValues = $values;
    }

    /**
     * @param string $fieldName
     * @return mixed
     * @throws \Exception
     */
    public function hasChanged($dbFieldName)
    {
        if (!array_key_exists($dbFieldName, $this->_initialValues)) {
            throw new \Exception($dbFieldName . ' field was not found');
        }
        $currentValues = $this->__toArray();

        return $currentValues[$dbFieldName] != $this->_initialValues[$dbFieldName];
    }

    public function getInitialValue($dbFieldName)
    {
        if (!array_key_exists($dbFieldName, $this->_initialValues)) {
            throw new \Exception($dbFieldName . ' field was not found');
        }

        return $this->_initialValues[$dbFieldName];
    }

    /**
     * @return array
     */
    public function getChangeSet()
    {
        return array_diff(
            $this->_initialValues,
            $this->__toArray()
        );
    }

    /**
     * @return PsAorDTO
     */
    public static function createDTO()
    {
        return new PsAorDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto PsAorDTO
         */
        Assertion::isInstanceOf($dto, PsAorDTO::class);

        $self = new static();

        return $self
            ->setDefaultExpiration($dto->getDefaultExpiration())
            ->setMaxContacts($dto->getMaxContacts())
            ->setMinimumExpiration($dto->getMinimumExpiration())
            ->setRemoveExisting($dto->getRemoveExisting())
            ->setAuthenticateQualify($dto->getAuthenticateQualify())
            ->setMaximumExpiration($dto->getMaximumExpiration())
            ->setSupportPath($dto->getSupportPath())
            ->setContact($dto->getContact())
            ->setQualifyFrequency($dto->getQualifyFrequency())
            ->setPsEndpoint($dto->getPsEndpoint())
        ;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto PsAorDTO
         */
        Assertion::isInstanceOf($dto, PsAorDTO::class);

        $this
            ->setDefaultExpiration($dto->getDefaultExpiration())
            ->setMaxContacts($dto->getMaxContacts())
            ->setMinimumExpiration($dto->getMinimumExpiration())
            ->setRemoveExisting($dto->getRemoveExisting())
            ->setAuthenticateQualify($dto->getAuthenticateQualify())
            ->setMaximumExpiration($dto->getMaximumExpiration())
            ->setSupportPath($dto->getSupportPath())
            ->setContact($dto->getContact())
            ->setQualifyFrequency($dto->getQualifyFrequency())
            ->setPsEndpoint($dto->getPsEndpoint());


        return $this;
    }

    /**
     * @return PsAorDTO
     */
    public function toDTO()
    {
        return self::createDTO()
            ->setDefaultExpiration($this->getDefaultExpiration())
            ->setMaxContacts($this->getMaxContacts())
            ->setMinimumExpiration($this->getMinimumExpiration())
            ->setRemoveExisting($this->getRemoveExisting())
            ->setAuthenticateQualify($this->getAuthenticateQualify())
            ->setMaximumExpiration($this->getMaximumExpiration())
            ->setSupportPath($this->getSupportPath())
            ->setContact($this->getContact())
            ->setQualifyFrequency($this->getQualifyFrequency())
            ->setPsEndpointId($this->getPsEndpoint() ? $this->getPsEndpoint()->getId() : null);
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'default_expiration' => self::getDefaultExpiration(),
            'max_contacts' => self::getMaxContacts(),
            'minimum_expiration' => self::getMinimumExpiration(),
            'remove_existing' => self::getRemoveExisting(),
            'authenticate_qualify' => self::getAuthenticateQualify(),
            'maximum_expiration' => self::getMaximumExpiration(),
            'support_path' => self::getSupportPath(),
            'contact' => self::getContact(),
            'qualify_frequency' => self::getQualifyFrequency(),
            'psEndpointId' => self::getPsEndpoint() ? self::getPsEndpoint()->getId() : null
        ];
    }


    // @codeCoverageIgnoreStart

    /**
     * Set defaultExpiration
     *
     * @param integer $defaultExpiration
     *
     * @return self
     */
    public function setDefaultExpiration($defaultExpiration = null)
    {
        if (!is_null($defaultExpiration)) {
            if (!is_null($defaultExpiration)) {
                Assertion::integerish($defaultExpiration);
            }
        }

        $this->defaultExpiration = $defaultExpiration;

        return $this;
    }

    /**
     * Get defaultExpiration
     *
     * @return integer
     */
    public function getDefaultExpiration()
    {
        return $this->defaultExpiration;
    }

    /**
     * Set maxContacts
     *
     * @param integer $maxContacts
     *
     * @return self
     */
    public function setMaxContacts($maxContacts = null)
    {
        if (!is_null($maxContacts)) {
            if (!is_null($maxContacts)) {
                Assertion::integerish($maxContacts);
            }
        }

        $this->maxContacts = $maxContacts;

        return $this;
    }

    /**
     * Get maxContacts
     *
     * @return integer
     */
    public function getMaxContacts()
    {
        return $this->maxContacts;
    }

    /**
     * Set minimumExpiration
     *
     * @param integer $minimumExpiration
     *
     * @return self
     */
    public function setMinimumExpiration($minimumExpiration = null)
    {
        if (!is_null($minimumExpiration)) {
            if (!is_null($minimumExpiration)) {
                Assertion::integerish($minimumExpiration);
            }
        }

        $this->minimumExpiration = $minimumExpiration;

        return $this;
    }

    /**
     * Get minimumExpiration
     *
     * @return integer
     */
    public function getMinimumExpiration()
    {
        return $this->minimumExpiration;
    }

    /**
     * Set removeExisting
     *
     * @param string $removeExisting
     *
     * @return self
     */
    public function setRemoveExisting($removeExisting = null)
    {
        if (!is_null($removeExisting)) {
        }

        $this->removeExisting = $removeExisting;

        return $this;
    }

    /**
     * Get removeExisting
     *
     * @return string
     */
    public function getRemoveExisting()
    {
        return $this->removeExisting;
    }

    /**
     * Set authenticateQualify
     *
     * @param string $authenticateQualify
     *
     * @return self
     */
    public function setAuthenticateQualify($authenticateQualify = null)
    {
        if (!is_null($authenticateQualify)) {
        }

        $this->authenticateQualify = $authenticateQualify;

        return $this;
    }

    /**
     * Get authenticateQualify
     *
     * @return string
     */
    public function getAuthenticateQualify()
    {
        return $this->authenticateQualify;
    }

    /**
     * Set maximumExpiration
     *
     * @param integer $maximumExpiration
     *
     * @return self
     */
    public function setMaximumExpiration($maximumExpiration = null)
    {
        if (!is_null($maximumExpiration)) {
            if (!is_null($maximumExpiration)) {
                Assertion::integerish($maximumExpiration);
            }
        }

        $this->maximumExpiration = $maximumExpiration;

        return $this;
    }

    /**
     * Get maximumExpiration
     *
     * @return integer
     */
    public function getMaximumExpiration()
    {
        return $this->maximumExpiration;
    }

    /**
     * Set supportPath
     *
     * @param string $supportPath
     *
     * @return self
     */
    public function setSupportPath($supportPath = null)
    {
        if (!is_null($supportPath)) {
        }

        $this->supportPath = $supportPath;

        return $this;
    }

    /**
     * Get supportPath
     *
     * @return string
     */
    public function getSupportPath()
    {
        return $this->supportPath;
    }

    /**
     * Set contact
     *
     * @param string $contact
     *
     * @return self
     */
    public function setContact($contact = null)
    {
        if (!is_null($contact)) {
            Assertion::maxLength($contact, 200);
        }

        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact
     *
     * @return string
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Set qualifyFrequency
     *
     * @param integer $qualifyFrequency
     *
     * @return self
     */
    public function setQualifyFrequency($qualifyFrequency = null)
    {
        if (!is_null($qualifyFrequency)) {
            if (!is_null($qualifyFrequency)) {
                Assertion::integerish($qualifyFrequency);
            }
        }

        $this->qualifyFrequency = $qualifyFrequency;

        return $this;
    }

    /**
     * Get qualifyFrequency
     *
     * @return integer
     */
    public function getQualifyFrequency()
    {
        return $this->qualifyFrequency;
    }

    /**
     * Set psEndpoint
     *
     * @param \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface $psEndpoint
     *
     * @return self
     */
    public function setPsEndpoint(\Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface $psEndpoint = null)
    {
        $this->psEndpoint = $psEndpoint;

        return $this;
    }

    /**
     * Get psEndpoint
     *
     * @return \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface
     */
    public function getPsEndpoint()
    {
        return $this->psEndpoint;
    }



    // @codeCoverageIgnoreEnd
}

