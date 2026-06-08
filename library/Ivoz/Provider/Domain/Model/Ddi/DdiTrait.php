<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\Ddi;

use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Recording\RecordingInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\Webhook\WebhookInterface;

/**
* @codeCoverageIgnore
*/
trait DdiTrait
{
    /**
     * @var ?int
     */
    protected $id = null;

    /**
     * @var Collection<array-key, RecordingInterface> & Selectable<array-key, RecordingInterface>
     * RecordingInterface mappedBy ddi
     */
    protected $recordings;

    /**
     * @var Collection<array-key, WebhookInterface> & Selectable<array-key, WebhookInterface>
     * WebhookInterface mappedBy ddi
     */
    protected $webhooks;

    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());
        $this->recordings = new ArrayCollection();
        $this->webhooks = new ArrayCollection();
    }

    abstract protected function sanitizeValues(): void;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DdiDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        $recordings = $dto->getRecordings();
        if (!is_null($recordings)) {

            /** @var Collection<array-key, RecordingInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $recordings
            );
            $self->replaceRecordings($replacement);
        }

        $webhooks = $dto->getWebhooks();
        if (!is_null($webhooks)) {

            /** @var Collection<array-key, WebhookInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $webhooks
            );
            $self->replaceWebhooks($replacement);
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
     * @param DdiDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        parent::updateFromDto($dto, $fkTransformer);
        $recordings = $dto->getRecordings();
        if (!is_null($recordings)) {

            /** @var Collection<array-key, RecordingInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $recordings
            );
            $this->replaceRecordings($replacement);
        }

        $webhooks = $dto->getWebhooks();
        if (!is_null($webhooks)) {

            /** @var Collection<array-key, WebhookInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $webhooks
            );
            $this->replaceWebhooks($replacement);
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): DdiDto
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

    public function addRecording(RecordingInterface $recording): DdiInterface
    {
        $recording->setDdi($this);
        $this->recordings->add($recording);

        return $this;
    }

    public function removeRecording(RecordingInterface $recording): DdiInterface
    {
        $recording->setDdi(null);

        return $this;
    }

    /**
     * @param Collection<array-key, RecordingInterface> $recordings
     */
    public function replaceRecordings(Collection $recordings): DdiInterface
    {
        foreach ($recordings as $entity) {
            $entity->setDdi($this);
        }

        $toStringCallable = fn(mixed $val): \Stringable|string => $val instanceof \Stringable ? $val : serialize($val);
        foreach ($this->recordings as $key => $entity) {
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
            foreach ($recordings as $newKey => $newEntity) {
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
                    unset($recordings[$newKey]);
                    $match = true;
                    break;
                }
            }

            if (!$match) {
                $this->recordings[$key]?->setDdi(null);
            }
        }

        foreach ($recordings as $entity) {
            $this->addRecording($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, RecordingInterface>
     */
    public function getRecordings(Criteria $criteria = null): array
    {
        /** @var ArrayCollection<int, RecordingInterface> $recordings */
        $recordings = $this->recordings->matching(
            Criteria::create()
                ->where(
                    Criteria::expr()
                        ->neq('ddi', null)
                ),
        );

        if (!is_null($criteria)) {
            return $recordings->matching($criteria)->toArray();
        }

        return $recordings->toArray();
    }

    public function addWebhook(WebhookInterface $webhook): DdiInterface
    {
        $this->webhooks->add($webhook);

        return $this;
    }

    public function removeWebhook(WebhookInterface $webhook): DdiInterface
    {
        $this->webhooks->removeElement($webhook);

        return $this;
    }

    /**
     * @param Collection<array-key, WebhookInterface> $webhooks
     */
    public function replaceWebhooks(Collection $webhooks): DdiInterface
    {
        foreach ($webhooks as $entity) {
            $entity->setDdi($this);
        }

        $toStringCallable = fn(mixed $val): \Stringable|string => $val instanceof \Stringable ? $val : serialize($val);
        foreach ($this->webhooks as $key => $entity) {
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
            foreach ($webhooks as $newKey => $newEntity) {
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
                    unset($webhooks[$newKey]);
                    $match = true;
                    break;
                }
            }

            if (!$match) {
                $this->webhooks->remove($key);
            }
        }

        foreach ($webhooks as $entity) {
            $this->addWebhook($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, WebhookInterface>
     */
    public function getWebhooks(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->webhooks->matching($criteria)->toArray();
        }

        return $this->webhooks->toArray();
    }
}
