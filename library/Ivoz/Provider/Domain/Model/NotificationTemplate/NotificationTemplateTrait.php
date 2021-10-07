<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\NotificationTemplate;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\NotificationTemplateContent\NotificationTemplateContentInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

/**
* @codeCoverageIgnore
*/
trait NotificationTemplateTrait
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var ArrayCollection
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

    abstract protected function sanitizeValues();

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param NotificationTemplateDto $dto
     * @param ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        if (!is_null($dto->getContents())) {
            $self->replaceContents(
                $fkTransformer->transformCollection(
                    $dto->getContents()
                )
            );
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
     * @param ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        parent::updateFromDto($dto, $fkTransformer);
        if (!is_null($dto->getContents())) {
            $this->replaceContents(
                $fkTransformer->transformCollection(
                    $dto->getContents()
                )
            );
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return NotificationTemplateDto
     */
    public function toDto($depth = 0)
    {
        $dto = parent::toDto($depth);
        return $dto
            ->setId($this->getId());
    }

    /**
     * @return array
     */
    protected function __toArray()
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

    public function replaceContents(ArrayCollection $contents): NotificationTemplateInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($contents as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setNotificationTemplate($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->contents as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->contents->set($key, $updatedEntities[$identity]);
            } else {
                $this->contents->remove($key);
            }
            unset($updatedEntities[$identity]);
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
