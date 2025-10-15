<?php

namespace Ivoz\Provider\Domain\Model\User;

use DomainException;
use Ivoz\Core\Domain\Assert\Assertion;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\Language\LanguageInterface;
use Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleInterface;
use Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUserInterface;
use Symfony\Component\Security\Core\User\LegacyPasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface as SymfonyUserInterface;
use Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface;

/**
 * User
 */
class User extends UserAbstract implements UserInterface, SymfonyUserInterface, LegacyPasswordAuthenticatedUserInterface, \Serializable
{
    use UserTrait;
    use UserSecurityTrait;

    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
     */
    public function getChangeSet(): array
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Return string representation of this entity
     * @return string
     */
    public function __toString(): string
    {
        return sprintf(
            "%s %s [%s]",
            $this->getName(),
            $this->getLastname(),
            parent::__toString()
        );
    }

    public function serialize(): string
    {
        return serialize(array(
            $this->id,
            $this->email,
            $this->pass,
            $this->active
        ));
    }

    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->email,
            $this->pass,
            $this->active
            ) = unserialize($serialized);
    }

    protected function sanitizeValues(): void
    {
        $isNew = !$this->getId();
        if ($isNew) {
            $this->sanitizeNew();
        }

        if ($this->getActive() && !$this->getEmail()) {
            throw new DomainException('You must set an email to enable user portal access');
        }

        if (!$this->getTimezone()) {
            $this->setTimezone(
                $this->getCompanyTimezone()
            );
        }

        $canAccessUserweb = ($this->getActive() && $this->getEmail());
        if ($canAccessUserweb) {
            // Avoid username/pass/active incoherences
            if (!$this->getPass()) {
                throw new \DomainException('Active users must have a password');
            }
        }

        $this->sanitizeLocation();
    }

    protected function sanitizeNew(): void
    {
        if ($this->getEmail() && $this->getPass()) {
            $this->setActive(true);
        }
    }

    protected function sanitizeLocation(): void
    {
        $useDefaultLocation = $this->getUseDefaultLocation();

        if (!$useDefaultLocation) {
            return;
        }

        $defaultLocation = $this
            ->getCompany()
            ->getLocation();

        $this->setLocation($defaultLocation);
    }

    public function setUseDefaultLocation(bool $useDefaultLocation): static
    {
        return parent::setUseDefaultLocation($useDefaultLocation);
    }

    /**
     * @inheritdoc
     */
    public function setPass(?string $pass = null): static
    {
        if ($pass === $this->getPass()) {
            return $this;
        }

        if (empty($pass)) {
            return parent::setPass(null);
        }

        $salt = substr(md5((string) random_int(0, mt_getrandmax()), false), 0, 22);
        $cryptPass = crypt(
            $pass,
            '$2a$08$' . $salt . '$' . $salt . '$'
        );

        return parent::setPass($cryptPass);
    }

    /**
     * return associated endpoint with the user
     *
     * @return \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface | null
     */
    public function getEndpoint()
    {
        $terminal = $this->getTerminal();
        if (!$terminal) {
            return null;
        }

        return $terminal->getPsEndpoint();
    }

    /**
     * @return string | null
     */
    public function getUserTerminalInterface()
    {
        $terminal = $this->getTerminal();
        if (empty($terminal)) {
            return null;
        }

        return $terminal->getName();
    }

    /**
     * @return string | null
     */
    public function getOutgoingDdiNumber()
    {
        $ddi = $this->getOutgoingDdi();
        if ($ddi) {
            return $ddi->getDdiE164();
        }

        return null;
    }


    /**
     * Get User outgoingDdi
     * If no Ddi is assigned, retrieve company's default Ddi
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface | null
     */
    public function getOutgoingDdi(): ?DdiInterface
    {
        $ddi = parent::getOutgoingDdi();
        if ($ddi) {
            return $ddi;
        }

        return $this
            ->getCompany()
            ->getOutgoingDdi();
    }

    public function setOutgoingDdi(?DdiInterface $outgoingDdi = null): static
    {
        return parent::setOutgoingDdi($outgoingDdi);
    }

    /**
     * Get User outgoingDdiRule
     * If no OutgoingDdiRule is assigned, retrieve company's default OutgoingDdiRule
     * @return \Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleInterface|null
     */
    public function getOutgoingDdiRule(): ?OutgoingDdiRuleInterface
    {
        $outgoingDdiRule = parent::getOutgoingDdiRule();
        if ($outgoingDdiRule) {
            return $outgoingDdiRule;
        }

        return $this
            ->getCompany()
            ->getOutgoingDdiRule();
    }


    /**
     * @return string
     */
    public function getExtensionNumber()
    {
        $extension = $this->getExtension();
        if ($extension) {
            return $extension
                ->getNumber();
        }

        return '';
    }

    /**
     * @param string $exten
     * @return bool canCall
     */
    public function isAllowedToCall($exten)
    {
        $callAcl = $this->getCallAcl();
        if (empty($callAcl)) {
            return true;
        }

        return $callAcl
            ->dstIsCallable($exten);
    }

    /**
     * @return (\Ivoz\Provider\Domain\Model\PickUpGroup\PickUpGroupInterface|null)[]
     *
     * @psalm-return array<array-key, \Ivoz\Provider\Domain\Model\PickUpGroup\PickUpGroupInterface|null>
     */
    public function getPickUpGroups(): array
    {
        $pickUpGroups = array();

        /**
         * @var PickUpRelUserInterface[] $pickUpRelUsers
         */
        $pickUpRelUsers = $this->getPickUpRelUsers();
        if (!empty($pickUpRelUsers)) {
            foreach ($pickUpRelUsers as $key => $pickUpRelUser) {
                $pickUpGroups[$key] = $pickUpRelUser->getPickUpGroup();
            }
        }

        return $pickUpGroups;
    }

    /**
     * @return string comma separated pickup group ids
     */
    public function getPickUpGroupsIds(): string
    {
        $pickUpGroupIds = array();

        /**
         * @var PickUpRelUserInterface[] $pickUpRelUsers
         */
        $pickUpRelUsers = $this->getPickUpRelUsers();
        if (!empty($pickUpRelUsers)) {
            foreach ($pickUpRelUsers as $pickUpRel) {
                if ($pickUpRel->hasBeenDeleted()) {
                    continue;
                }

                array_push($pickUpGroupIds, $pickUpRel->getPickUpGroup()->getId());
            }
        }

        return join(',', $pickUpGroupIds);
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        return
            $this->getName()
            . ' '
            . $this->getLastname();
    }

    /**
     * @return array
     */
    public function toArrayPortalForm()
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getFullName()
        ];
    }

    /**
     * @return bool
     */
    public function canBeCalled()
    {
        // Check if user is valid to be called
        if (!$this->getActive()) {
            return false;
        }

        // Check if user has terminal configured
        if (empty($this->getTerminal())) {
            return false;
        }
        // Check if user has extension configured
        // Looks like a complete user
        return !empty($this->getExtension());
    }

    /**
     * returns company language if empty
     */
    public function getLanguage(): LanguageInterface
    {
        $language = parent::getLanguage();
        if ($language) {
            return $language;
        }

        return $this->getCompany()->getLanguage();
    }

    /**
     * Get User language code.
     * If not set, get the company language code
     * @return string
     */
    public function getLanguageCode()
    {
        return $this
            ->getLanguage()
            ->getIden();
    }

    public function setEmail(?string $email = null): static
    {
        if ($email === '') {
            // '' is NULL (avoid triggering the UNIQUE KEY)
            $email = null;
        }

        if ($email !== null) {
            Assertion::email($email);
        }

        return parent::setEmail($email);
    }

    protected function setName(string $name): static
    {
        if ($name === '') {
            throw new DomainException('Name cannot be empty');
        }

        return parent::setName($name);
    }

    protected function setLastname(string $lastname): static
    {
        if ($lastname === '') {
            throw new DomainException('Lastname cannot be empty');
        }

        return parent::setLastname($lastname);
    }

    private function getCompanyTimezone(): ?TimezoneInterface
    {
        return $this
            ->getCompany()
            ->getDefaultTimezone();
    }

    /**
     * @return string
     */
    public function getFullNameExtension(): string
    {
        return sprintf(
            "%s %s (%s)",
            $this->getName(),
            $this->getLastname(),
            $this->getExtensionNumber()
        );
    }
}
