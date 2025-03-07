<?php

namespace Ivoz\Provider\Domain\Model\Administrator;

use Ivoz\Core\Domain\Assert\Assertion;
use Symfony\Component\Security\Core\User\LegacyPasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Administrator
 */
class Administrator extends AdministratorAbstract implements
    AdministratorInterface,
    UserInterface,
    LegacyPasswordAuthenticatedUserInterface,
    \Serializable
{
    const ROLE_SUPER_ADMIN = 'ROLE_SUPER_ADMIN';
    const ROLE_BRAND_ADMIN = 'ROLE_BRAND_ADMIN';
    const ROLE_COMPANY_ADMIN = 'ROLE_COMPANY_ADMIN';
    private null|string $onBehalfOf = null;

    use AdministratorTrait, AdministratorSecurityTrait {
        AdministratorTrait::getRelPublicEntities insteadof AdministratorSecurityTrait;
    }

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

    public function __toString(): string
    {
        $userName = sprintf(
            "%s [%s]",
            $this->getUsername(),
            parent::__toString(),
        );

        if ($this->getOnBehalfOf()) {
            $userName = $this->getOnBehalfOf() . ' > ' . $userName;
        }

        return $userName;
    }

    public function setOnBehalfOf(string $adminName): void
    {
        $this->onBehalfOf = $adminName;
    }

    public function getOnBehalfOf(): string|null
    {
        return $this->onBehalfOf;
    }

    /**
     * @inheritdoc
     */
    public function setPass(string $pass = null): static
    {
        if (
            $this->isInitialized()
            && $pass === $this->getPass()
        ) {
            return $this;
        }

        if (empty($pass)) {
            return parent::setPass(null);
        }

        $salt = substr(md5((string)random_int(0, mt_getrandmax()), false), 0, 22);
        $cryptPass = crypt(
            $pass,
            '$2a$08$' . $salt . '$' . $salt . '$'
        );

        return parent::setPass($cryptPass);
    }

    /**
     * @return bool
     */
    public function isSuperAdmin()
    {
        $nullBrand = is_null($this->getBrand());
        $nullCompany = is_null($this->getCompany());

        return $nullBrand && $nullCompany;
    }

    /**
     * @return bool
     */
    public function isBrandAdmin(): bool
    {
        if ($this->isSuperAdmin()) {
            return true;
        }

        return is_null($this->getCompany());
    }

    public function isVpbxAdmin(): bool
    {
        $company = $this->getCompany();
        if (!$company) {
            return false;
        }

        return $company->isVpbx();
    }

    public function isResidentialAdmin(): bool
    {
        $company = $this->getCompany();
        if (!$company) {
            return false;
        }

        return $company->isResidential();
    }

    public function isRetailAdmin(): bool
    {
        $company = $this->getCompany();
        if (!$company) {
            return false;
        }

        return $company->isRetail();
    }

    public function isWholesaleAdmin(): bool
    {
        $company = $this->getCompany();
        if (!$company) {
            return false;
        }

        return $company->isWholesale();
    }

    public function companyHasFeature(string $iden): bool
    {
        $company = $this->getCompany();
        if ($company) {
            return $company->hasFeatureByIden($iden);
        }

        return false;
    }

    public function brandHasFeature(string $iden): bool
    {
        $brand = $this->getBrand();
        if ($brand) {
            return $brand->hasFeatureByIden($iden);
        }

        return false;
    }

    public function serialize(): string
    {
        return serialize($this->__serialize());
    }

    public function unserialize($serialized)
    {
        /** @var array{
         * id: int|null,
         * username: string,
         * pass: string|null,
         * email: string,
         * active: bool
         * } $data */
        $data = unserialize($serialized);

        $this->__unserialize($data);
    }

    /**
     * @return array{
     *     id: int|null,
     *     username: string,
     *     pass: string|null,
     *     email: string,
     *     active: bool
     * }
     */

    public function __serialize(): array
    {
        return [
            "id" => $this->id,
            "username" => $this->username,
            "pass" => $this->pass,
            "email" => $this->email,
            "active" => $this->active
        ];
    }

    /**
     * @param array{
     *      id: int|null,
     *      username: string,
     *      pass: string|null,
     *      email: string,
     *      active: bool
     *  } $data
     * @return void
     */
    public function __unserialize(array $data): void
    {
        $this->id = $data['id'];
        $this->username = $data["username"];
        $this->pass = $data['pass'];
        $this->email = $data['email'];
        $this->active = $data['active'];
    }

    protected function sanitizeValues(): void
    {
        if ($this->getRestricted() === false) {
            $this->setCanImpersonate(true);
        }

        $this->sanitizePassword();
    }

    protected function sanitizePassword(): void
    {
        $isNew = $this->isNew();
        $emptyPass = empty($this->getPass());

        if ($isNew && $emptyPass) {
            $this->setActive(false);
            return;
        }

        $isActive = $this->getActive();
        if ($emptyPass && $isActive) {
            throw new \DomainException('Password cannot be empty for an active user');
        }
    }

    protected function setEmail(string $email): static
    {
        if ($email !== '') {
            Assertion::email($email);
        }

        return parent::setEmail($email); // TODO: Change the autogenerated stub
    }
}
