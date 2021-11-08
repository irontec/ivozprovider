<?php

namespace Ivoz\Provider\Domain\Model\CallForwardSetting;

use Assert\Assertion;
use Ivoz\Provider\Domain\Traits\RoutableTrait;

/**
 * CallForwardSetting
 */
class CallForwardSetting extends CallForwardSettingAbstract implements CallForwardSettingInterface
{
    use CallForwardSettingTrait;
    use RoutableTrait;

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
     * {@inheritDoc}
     */
    protected function sanitizeValues(): void
    {
        // Set Routable options to avoid naming collision
        $this->routeTypes = [
            'voicemail',
            'number',
            'extension'
        ];

        $this->sanitizeRouteValues();

        // Timeout only makes sense in NoAnswer Call Forwards
        if ($this->callForwardType != self::CALLFORWARDTYPE_NOANSWER) {
            $this->setNoAnswerTimeout(0);
        }

        $retailAccount = $this->getRetailAccount();
        if (!$retailAccount) {
            // DDI criteria is only supported for retail call-forwards
            $this->setDdi(null);

            return;
        }

        $isValidRetailCfs = in_array(
            $this->getCallForwardType(),
            [
                CallForwardSettingInterface::CALLFORWARDTYPE_USERNOTREGISTERED,
                CallForwardSettingInterface::CALLFORWARDTYPE_INCONDITIONAL,
            ],
            true
        );

        if (!$isValidRetailCfs) {
            $errorMsg = sprintf(
                'Only %s and %s call forward types are allowed for retail clients',
                CallForwardSettingInterface::CALLFORWARDTYPE_USERNOTREGISTERED,
                CallForwardSettingInterface::CALLFORWARDTYPE_INCONDITIONAL
            );
            throw new \DomainException($errorMsg);
        }
    }

    /**
     * {@inheritDoc}
     *
     * @throws \InvalidArgumentException
     */
    public function setNumberValue(?string $numberValue = null): static
    {
        if (!empty($numberValue)) {
            Assertion::regex($numberValue, '/^[0-9]+$/');
        }
        return parent::setNumberValue($numberValue);
    }

    /**
     * @return (int|mixed|null|string)[]
     *
     * @psalm-return array{id: int|null, userId: mixed, callTypeFilter: string, callForwardType: string, targetType: null|string, numberValue: mixed, extensionId: mixed|null, extension: string, voicemailId: mixed|null, voicemail: string, noAnswerTimeout: int}
     */
    public function toArrayPortal()
    {
        $response = [];
        $response['id'] = $this->getId();
        $response['userId'] = $this->getUser()->getId();

        $numberValue = $this->getNumberValue();
        settype($numberValue, "integer");

        $response['callTypeFilter'] = $this->getCallTypeFilter();
        $response['callForwardType'] = $this->getCallForwardType();
        $response['targetType'] = $this->getTargetType();
        $response['numberValue'] = $numberValue;
        $response['extensionId'] = $this->getExtension()->getId();

        $response['extensionId'] = null;
        $response['extension'] = '';
        $extension = $this->getExtension();

        if (!is_null($extension)) {
            $response['extensionId'] = $extension->getId();
            $response['extension'] = $extension->getNumber();
        }

        $voicemail = $this->getVoicemail();
        $response['voicemailId'] = $voicemail
            ? $voicemail->getId()
            : null;
        $response['voicemail'] = $voicemail
            ? $voicemail->getName()
            : '';
        $response['noAnswerTimeout'] = $this->getNoAnswerTimeout();

        return $response;
    }

    /**
     * Get the numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getNumberValueE164()
    {
        if (!$this->getNumberCountry()) {
            return "";
        }

        return
            $this->getNumberCountry()->getCountryCode() .
            $this->getNumberValue();
    }

    /**
     * Alias for getTargetType
     *
     * @todo rename tagetType field to routeType
     */
    public function getRouteType(): ?string
    {
        return $this->getTargetType();
    }

    public function getCallForwardTarget(): ?string
    {
        if ($this->getRouteType() == CallForwardSettingInterface::TARGETTYPE_RETAIL) {
            return $this->getCfwToRetailAccount()->getName();
        }

        return $this->getTarget();
    }
}
