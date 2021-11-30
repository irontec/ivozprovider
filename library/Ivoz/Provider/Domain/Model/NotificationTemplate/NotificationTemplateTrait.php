<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\NotificationTemplate;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
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
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($contents as $entity) {
            /** @var string|int $index */
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setNotificationTemplate($this);
        }

        foreach ($this->contents as $key => $entity) {
            $identity = $entity->getId();
            if (!$identity) {
                $this->contents->remove($key);
                continue;
            }

            if (array_key_exists($identity, $updatedEntities)) {
                $this->contents->set($key, $updatedEntities[$identity]);
                unset($updatedEntities[$identity]);
            } else {
                $this->contents->remove($key);
            }
        }

        foreach ($updatedEntities as $entity) {
            $this->addContent($entity);
        }

        return $this;
    }

    public function getContents(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->contents->matching($criteria)->toArray();
        }

        return $this->contents->toArray();
    }
}
