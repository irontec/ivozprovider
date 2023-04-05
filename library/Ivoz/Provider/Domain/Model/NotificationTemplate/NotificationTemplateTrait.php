<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\NotificationTemplate;

use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\NotificationTemplateContent\NotificationTemplateContentInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Collections\Criteria;

/**
* @codeCoverageIgnore
*/
trait NotificationTemplateTrait
{
    /**
     * @var ?int
     */
    protected $id = null;

    /**
     * @var Collection<array-key, NotificationTemplateContentInterface> & Selectable<array-key, NotificationTemplateContentInterface>
     * NotificationTemplateContentInterface mappedBy notificationTemplate
     */
    protected $contents;

    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());
        $this->contents = new ArrayCollection();
    }

    abstract protected function sanitizeValues(): void;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param NotificationTemplateDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        $contents = $dto->getContents();
        if (!is_null($contents)) {

            /** @var Collection<array-key, NotificationTemplateContentInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $contents
            );
            $self->replaceContents($replacement);
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
     * @param NotificationTemplateDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        parent::updateFromDto($dto, $fkTransformer);
        $contents = $dto->getContents();
        if (!is_null($contents)) {

            /** @var Collection<array-key, NotificationTemplateContentInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $contents
            );
            $this->replaceContents($replacement);
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): NotificationTemplateDto
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

    public function addContent(NotificationTemplateContentInterface $content): NotificationTemplateInterface
    {
        $this->contents->add($content);

        return $this;
    }

    public function removeContent(NotificationTemplateContentInterface $content): NotificationTemplateInterface
    {
        $this->contents->removeElement($content);

        return $this;
    }

    /**
     * @param Collection<array-key, NotificationTemplateContentInterface> $contents
     */
    public function replaceContents(Collection $contents): NotificationTemplateInterface
    {
        foreach ($contents as $entity) {
            $entity->setNotificationTemplate($this);
        }

        $toStringCallable = fn(mixed $val): \Stringable|string => $val instanceof \Stringable ? $val : serialize($val);
        foreach ($this->contents as $key => $entity) {
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
            foreach ($contents as $newKey => $newEntity) {
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
                    unset($contents[$newKey]);
                    $match = true;
                    break;
                }
            }

            if (!$match) {
                $this->contents->remove($key);
            }
        }

        foreach ($contents as $entity) {
            $this->addContent($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, NotificationTemplateContentInterface>
     */
    public function getContents(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->contents->matching($criteria)->toArray();
        }

        return $this->contents->toArray();
    }
}
