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
        $user = $this->getUser();

        if (!is_null($company)) {
            $companyBrand = $company->getBrand();

            if ($brand->getId() !== $companyBrand->getId()) {
                throw new \DomainException(
                    'Company does not belong to the specified brand'
                );
            }

            $this->setBrand($companyBrand);
        }

        if (!is_null($ddi)) {
            $ddiCompany = $ddi->getCompany();

            if (is_null($company)) {
                $this->setCompany($ddiCompany);
            } elseif ($company->getId() !== $ddiCompany?->getId()) {
                throw new \DomainException(
                    'DDI does not belong to the specified company'
                );
            }
        }

        if (!is_null($user)) {
            $userCompany = $user->getCompany();

            if (is_null($company)) {
                $this->setCompany($userCompany);
            } elseif ($company->getId() !== $user->getCompany()->getId()) {
                throw new \DomainException('User does not belong to the specified company');
            }
        }

        if (!is_null($user) && !is_null($ddi)) {
            throw new \DomainException('Webhook can not be bound to both ddi and user');
        }

        $this->sanitizeWebhookConfiguration();
    }

    protected function setUri(string $uri): static
    {
        Assertion::url($uri, 'uri value "%s" is not a valid URL.');

        return parent::setUri($uri);
    }

    private const VALID_TEMPLATE_PLACEHOLDERS_BRAND = [
        'event', 'time', 'callId', 'company', 'companyId',
        'ddiId', 'crId', 'dpId', 'direction',
        'caller', 'callee', 'carrier', 'ddiProvider', 'iden',
    ];

    private const VALID_TEMPLATE_PLACEHOLDERS_USER = [
        'event', 'callId', 'direction', 'owner', 'party', 'userId', 'time', 'iden',
    ];

    protected function sanitizeWebhookConfiguration(): void
    {
        $hasAnyEvent = $this->getEventStart() ||
                      $this->getEventRing() ||
                      $this->getEventAnswer() ||
                      $this->getEventEnd() ||
                      $this->getEventUpdateClid();

        if (!$hasAnyEvent) {
            throw new \DomainException('At least one event (Start, Ring, Answer, or End) must be enabled');
        }

        $validPlaceholders = !is_null($this->getUser())
            ? self::VALID_TEMPLATE_PLACEHOLDERS_USER
            : self::VALID_TEMPLATE_PLACEHOLDERS_BRAND;

        preg_match_all('/\{\{(\w+)\}\}/', $this->getTemplate(), $matches);
        $invalid = array_diff($matches[1], $validPlaceholders);
        if (!empty($invalid)) {
            throw new \DomainException('Invalid template placeholders: ' . implode(', ', $invalid));
        }
    }
}
