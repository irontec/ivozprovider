<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\Friend;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface;
use Ivoz\Ast\Domain\Model\PsIdentify\PsIdentifyInterface;
use Ivoz\Provider\Domain\Model\FriendsPattern\FriendsPatternInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingInterface;

/**
* @codeCoverageIgnore
*/
trait FriendTrait
{
    /**
     * @var ?int
     */
    protected $id = null;

    /**
     * @var PsEndpointInterface
     * mappedBy friend
     */
    protected $psEndpoint;

    /**
     * @var PsIdentifyInterface
     * mappedBy friend
     */
    protected $psIdentify;

    /**
     * @var Collection<array-key, FriendsPatternInterface> & Selectable<array-key, FriendsPatternInterface>
     * FriendsPatternInterface mappedBy friend
     */
    protected $patterns;

    /**
     * @var Collection<array-key, CallForwardSettingInterface> & Selectable<array-key, CallForwardSettingInterface>
     * CallForwardSettingInterface mappedBy friend
     */
    protected $callForwardSettings;

    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());
        $this->patterns = new ArrayCollection();
        $this->callForwardSettings = new ArrayCollection();
    }

    abstract protected function sanitizeValues(): void;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param FriendDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
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

        $patterns = $dto->getPatterns();
        if (!is_null($patterns)) {

            /** @var Collection<array-key, FriendsPatternInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $patterns
            );
            $self->replacePatterns($replacement);
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
     * @param FriendDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        parent::updateFromDto($dto, $fkTransformer);
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

        $patterns = $dto->getPatterns();
        if (!is_null($patterns)) {

            /** @var Collection<array-key, FriendsPatternInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $patterns
            );
            $this->replacePatterns($replacement);
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
    public function toDto(int $depth = 0): FriendDto
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

    public function addPattern(FriendsPatternInterface $pattern): FriendInterface
    {
        $this->patterns->add($pattern);

        return $this;
    }

    public function removePattern(FriendsPatternInterface $pattern): FriendInterface
    {
        $this->patterns->removeElement($pattern);

        return $this;
    }

    /**
     * @param Collection<array-key, FriendsPatternInterface> $patterns
     */
    public function replacePatterns(Collection $patterns): FriendInterface
    {
        foreach ($patterns as $entity) {
            $entity->setFriend($this);
        }

        $toStringCallable = fn(mixed $val): \Stringable|string => $val instanceof \Stringable ? $val : serialize($val);
        foreach ($this->patterns as $key => $entity) {
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
            foreach ($patterns as $newKey => $newEntity) {
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
                    unset($patterns[$newKey]);
                    $match = true;
                    break;
                }
            }

            if (!$match) {
                $this->patterns->remove($key);
            }
        }

        foreach ($patterns as $entity) {
            $this->addPattern($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, FriendsPatternInterface>
     */
    public function getPatterns(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->patterns->matching($criteria)->toArray();
        }

        return $this->patterns->toArray();
    }

    public function addCallForwardSetting(CallForwardSettingInterface $callForwardSetting): FriendInterface
    {
        $this->callForwardSettings->add($callForwardSetting);

        return $this;
    }

    public function removeCallForwardSetting(CallForwardSettingInterface $callForwardSetting): FriendInterface
    {
        $this->callForwardSettings->removeElement($callForwardSetting);

        return $this;
    }

    /**
     * @param Collection<array-key, CallForwardSettingInterface> $callForwardSettings
     */
    public function replaceCallForwardSettings(Collection $callForwardSettings): FriendInterface
    {
        foreach ($callForwardSettings as $entity) {
            $entity->setFriend($this);
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
