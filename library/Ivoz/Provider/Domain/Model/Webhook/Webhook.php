<?php

namespace Ivoz\Provider\Domain\Model\Webhook;

use Ivoz\Core\Domain\Assert\Assertion;

/**
 * Webhook
 */
class Webhook extends WebhookAbstract implements WebhookInterface
{
    use WebhookTrait;

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
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    protected function sanitizeValues(): void
    {
        $company = $this->getCompany();
        $brand = $this->getBrand();
        $ddi = $this->getDdi();

        if (!is_null($company)) {
            $companyBrand = $company->getBrand();

            if ($brand->getId() !== $companyBrand->getId()) {
                throw new \DomainException('Company does not belong to the specified brand');
            }

            $this->setBrand($companyBrand);
        }

        if (!is_null($ddi)) {
            $ddiCompany = $ddi->getCompany();

            if (is_null($company)) {
                $this->setCompany($ddiCompany);
            } elseif ($company->getId() !== $ddiCompany?->getId()) {
                throw new \DomainException('DDI does not belong to the specified company');
            }
        }

        $this->sanitizeWebhookConfiguration();
    }

    protected function setUri(string $uri): static
    {
        Assertion::url($uri, 'uri value "%s" is not a valid URL.');

        return parent::setUri($uri);
    }

    protected function sanitizeWebhookConfiguration(): void
    {
        $hasAnyEvent = $this->getEventStart() ||
                      $this->getEventRing() ||
                      $this->getEventAnswer() ||
                      $this->getEventEnd();

        if (!$hasAnyEvent) {
            throw new \DomainException('At least one event (Start, Ring, Answer, or End) must be enabled');
        }
    }
}
