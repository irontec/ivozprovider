<?php

namespace Ivoz\Provider\Domain\Model\WebPortal;

use Assert\Assertion;
use Ivoz\Core\Domain\Model\TempFileContainnerTrait;
use Ivoz\Core\Domain\Service\FileContainerInterface;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

/**
 * WebPortal
 */
class WebPortal extends WebPortalAbstract implements FileContainerInterface, WebPortalInterface
{
    use WebPortalTrait;
    use TempFileContainnerTrait;

    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
     */
    public function getChangeSet(): array
    {
        return parent::getChangeSet();
    }

    protected function sanitizeValues(): void
    {
        $isGodUrlType = $this->getUrlType() === self::URLTYPE_GOD;

        if ($isGodUrlType) {
            $this->setBrand(null);
        } elseif (!$this->getBrand()) {
            $errorMsg = sprintf(
                'Brand is required in %s urls',
                $this->getUrlType()
            );
            throw new \DomainException($errorMsg);
        }

        $this->sanitizeCompany();
    }

    protected function sanitizeCompany(): void
    {
        $isGeneric = is_null($this->getCompany());
        if ($isGeneric) {
            return;
        }

        $isUserUrlType = $this->getUrlType() === self::URLTYPE_USER;
        if ($isUserUrlType && !$this->getCompany()?->isVpbx()) {
            throw new \DomainException("Company must be vpbx in user urls");
        }

        $companyBrandId = $this->getCompany()?->getBrand()->getId();
        $brandId = $this->getBrand()?->getId();
        if ($companyBrandId !== $brandId) {
            throw new \DomainException("Company brand must be identical to Brand");
        }
    }

    /**
     * @return array
     */
    public function getFileObjects(int $filter = null): array
    {
        $fileObjects = [
            'Logo' => [
                FileContainerInterface::DOWNLOADABLE_FILE,
                FileContainerInterface::UPDALOADABLE_FILE
            ]
        ];

        return $this->filterFileObjects(
            $fileObjects,
            $filter
        );
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
     * @return static
     */
    public function setUrl(string $url): static
    {
        Assertion::regex($url, '#^https://.*$#');
        return parent::setUrl($url);
    }
}
