<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\ResidentialDevice;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailInterface;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface;
use Ivoz\Ast\Domain\Model\PsIdentify\PsIdentifyInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingInterface;

/**
* @codeCoverageIgnore
*/
trait ResidentialDeviceTrait
{
    /**
     * @var ?int
     */
    protected $id = null;

    /**
     * @var VoicemailInterface
     * mappedBy residentialDevice
     */
    protected $voicemail;

    /**
     * @var PsEndpointInterface
     * mappedBy residentialDevice
     */
    protected $psEndpoint;

    /**
     * @var PsIdentifyInterface
     * mappedBy residentialDevice
     */
    protected $psIdentify;

    /**
     * @var Collection<array-key, DdiInterface> & Selectable<array-key, DdiInterface>
     * DdiInterface mappedBy residentialDevice
     */
    protected $ddis;

    /**
     * @var Collection<array-key, CallForwardSettingInterface> & Selectable<array-key, CallForwardSettingInterface>
     * CallForwardSettingInterface mappedBy residentialDevice
     */
    protected $callForwardSettings;

    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());
        $this->ddis = new ArrayCollection();
        $this->callForwardSettings = new ArrayCollection();
    }

    abstract protected function sanitizeValues(): void;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param ResidentialDeviceDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        if (!is_null($dto->getVoicemail())) {
            /** @var VoicemailInterface $entity */
            $entity = $fkTransformer->transform(
                $dto->getVoicemail()
            );
            $self->setVoicemail($entity);
        }

        if (!is_null($dto->getPsEndpoint())) {
            /** @var PsEndpointInterface $entity */
            $entity = $fkTransformer->transform(
                $dto->getPsEndpoint()
            );
            $self->setPsEndpoint($entity);
        }

        if (!is_null($dto->getPsIdentify())) {
            /** @var PsIdentifyInterface $entity */
            $entity = $fkTransformer->transform(
                $dto->getPsIdentify()
            );
            $self->setPsIdentify($entity);
        }

        $ddis = $dto->getDdis();
        if (!is_null($ddis)) {

            /** @var Collection<array-key, DdiInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $ddis
            );
            $self->replaceDdis($replacement);
        }

        $callForwardSettings = $dto->getCallForwardSettings();
        if (!is_null($callForwardSettings)) {

            /** @var Collection<array-key, CallForwardSettingInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $callForwardSettings
            );
            $self->replaceCallForwardSettings($replacement);
        }

        $self->sanitizeValues();
        if ($dto->getId()) {
            $self->id = $dto->getId();
            $self->initChangelog();
        }

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param ResidentialDeviceDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        parent::updateFromDto($dto, $fkTransformer);
        if (!is_null($dto->getVoicemail())) {
            /** @var VoicemailInterface $entity */
            $entity = $fkTransformer->transform(
                $dto->getVoicemail()
            );
            $this->setVoicemail($entity);
        }

        if (!is_null($dto->getPsEndpoint())) {
            /** @var PsEndpointInterface $entity */
            $entity = $fkTransformer->transform(
                $dto->getPsEndpoint()
            );
            $this->setPsEndpoint($entity);
        }

        if (!is_null($dto->getPsIdentify())) {
            /** @var PsIdentifyInterface $entity */
            $entity = $fkTransformer->transform(
                $dto->getPsIdentify()
            );
            $this->setPsIdentify($entity);
        }

        $ddis = $dto->getDdis();
        if (!is_null($ddis)) {

            /** @var Collection<array-key, DdiInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $ddis
            );
            $this->replaceDdis($replacement);
        }

        $callForwardSettings = $dto->getCallForwardSettings();
        if (!is_null($callForwardSettings)) {

            /** @var Collection<array-key, CallForwardSettingInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $callForwardSettings
            );
            $this->replaceCallForwardSettings($replacement);
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): ResidentialDeviceDto
    {
        $dto = parent::toDto($depth);
        return $dto
            ->setId($this->getId());
    }

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
    {
        return parent::__toArray() + [
            'id' => self::getId()
        ];
    }

    public function setVoicemail(VoicemailInterface $voicemail): static
    {
        $this->voicemail = $voicemail;

        return $this;
    }

    public function getVoicemail(): ?VoicemailInterface
    {
        return $this->voicemail;
    }

    public function setPsEndpoint(PsEndpointInterface $psEndpoint): static
    {
        $this->psEndpoint = $psEndpoint;

        return $this;
    }

    public function getPsEndpoint(): ?PsEndpointInterface
    {
        return $this->psEndpoint;
    }

    public function setPsIdentify(PsIdentifyInterface $psIdentify): static
    {
        $this->psIdentify = $psIdentify;

        return $this;
    }

    public function getPsIdentify(): ?PsIdentifyInterface
    {
        return $this->psIdentify;
    }

    public function addDdi(DdiInterface $ddi): ResidentialDeviceInterface
    {
        $this->ddis->add($ddi);

        return $this;
    }

    public function removeDdi(DdiInterface $ddi): ResidentialDeviceInterface
    {
        $this->ddis->removeElement($ddi);

        return $this;
    }

    /**
     * @param Collection<array-key, DdiInterface> $ddis
     */
    public function replaceDdis(Collection $ddis): ResidentialDeviceInterface
    {
        foreach ($ddis as $entity) {
            $entity->setResidentialDevice($this);
        }

        $toStringCallable = fn(mixed $val): \Stringable|string => $val instanceof \Stringable ? $val : serialize($val);
        foreach ($this->ddis as $key => $entity) {
            /**
             * @psalm-suppress MixedArgument
             */
            $currentValue = array_map(
                $toStringCallable,
                (function (): array {
                    return $this->__toArray(); /** @phpstan-ignore-line */
                })->call($entity)
            );

            $match = false;
            foreach ($ddis as $newKey => $newEntity) {
                /**
                 * @psalm-suppress MixedArgument
                 */
                $newValue = array_map(
                    $toStringCallable,
                    (function (): array {
                        return $this->__toArray(); /** @phpstan-ignore-line */
                    })->call($newEntity)
                );

                $diff = array_diff_assoc(
                    $currentValue,
                    $newValue
                );
                unset($diff['id']);

                if (empty($diff)) {
                    unset($ddis[$newKey]);
                    $match = true;
                    break;
                }
            }

            if (!$match) {
                $this->ddis->remove($key);
            }
        }

        foreach ($ddis as $entity) {
            $this->addDdi($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, DdiInterface>
     */
    public function getDdis(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->ddis->matching($criteria)->toArray();
        }

        return $this->ddis->toArray();
    }

    public function addCallForwardSetting(CallForwardSettingInterface $callForwardSetting): ResidentialDeviceInterface
    {
        $this->callForwardSettings->add($callForwardSetting);

        return $this;
    }

    public function removeCallForwardSetting(CallForwardSettingInterface $callForwardSetting): ResidentialDeviceInterface
    {
        $this->callForwardSettings->removeElement($callForwardSetting);

        return $this;
    }

    /**
     * @param Collection<array-key, CallForwardSettingInterface> $callForwardSettings
     */
    public function replaceCallForwardSettings(Collection $callForwardSettings): ResidentialDeviceInterface
    {
        foreach ($callForwardSettings as $entity) {
            $entity->setResidentialDevice($this);
        }

        $toStringCallable = fn(mixed $val): \Stringable|string => $val instanceof \Stringable ? $val : serialize($val);
        foreach ($this->callForwardSettings as $key => $entity) {
            /**
             * @psalm-suppress MixedArgument
             */
            $currentValue = array_map(
                $toStringCallable,
                (function (): array {
                    return $this->__toArray(); /** @phpstan-ignore-line */
                })->call($entity)
            );

            $match = false;
            foreach ($callForwardSettings as $newKey => $newEntity) {
                /**
                 * @psalm-suppress MixedArgument
                 */
                $newValue = array_map(
                    $toStringCallable,
                    (function (): array {
                        return $this->__toArray(); /** @phpstan-ignore-line */
                    })->call($newEntity)
                );

                $diff = array_diff_assoc(
                    $currentValue,
                    $newValue
                );
                unset($diff['id']);

                if (empty($diff)) {
                    unset($callForwardSettings[$newKey]);
                    $match = true;
                    break;
                }
            }

            if (!$match) {
                $this->callForwardSettings->remove($key);
            }
        }

        foreach ($callForwardSettings as $entity) {
            $this->addCallForwardSetting($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, CallForwardSettingInterface>
     */
    public function getCallForwardSettings(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->callForwardSettings->matching($criteria)->toArray();
        }

        return $this->callForwardSettings->toArray();
    }
}
