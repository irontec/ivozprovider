<?php

namespace Ivoz\Provider\Domain\Model\NotificationTemplate;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;

/**
 * NotificationTemplateTrait
 * @codeCoverageIgnore
 */
trait NotificationTemplateTrait
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var Collection
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

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @param \Ivoz\Core\Application\ForeignKeyTransformerInterface  $fkTransformer
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /**
         * @var $dto NotificationTemplateDto
         */
        $self = parent::fromDto($dto, $fkTransformer);
        if (!is_null($dto->getContents())) {
            $self->replaceContents(
                $fkTransformer->transformCollection(
                    $dto->getContents()
                )
            );
        }
        if ($dto->getId()) {
            $self->id = $dto->getId();
            $self->initChangelog();
        }

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @param \Ivoz\Core\Application\ForeignKeyTransformerInterface  $fkTransformer
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /**
         * @var $dto NotificationTemplateDto
         */
        parent::updateFromDto($dto, $fkTransformer);
        if (!is_null($dto->getContents())) {
            $this->replaceContents(
                $fkTransformer->transformCollection(
                    $dto->getContents()
                )
            );
        }
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
    /**
     * Add content
     *
     * @param \Ivoz\Provider\Domain\Model\NotificationTemplateContent\NotificationTemplateContentInterface $content
     *
     * @return NotificationTemplateTrait
     */
    public function addContent(\Ivoz\Provider\Domain\Model\NotificationTemplateContent\NotificationTemplateContentInterface $content)
    {
        $this->contents->add($content);

        return $this;
    }

    /**
     * Remove content
     *
     * @param \Ivoz\Provider\Domain\Model\NotificationTemplateContent\NotificationTemplateContentInterface $content
     */
    public function removeContent(\Ivoz\Provider\Domain\Model\NotificationTemplateContent\NotificationTemplateContentInterface $content)
    {
        $this->contents->removeElement($content);
    }

    /**
     * Replace contents
     *
     * @param \Ivoz\Provider\Domain\Model\NotificationTemplateContent\NotificationTemplateContentInterface[] $contents
     * @return self
     */
    public function replaceContents(Collection $contents)
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

    /**
     * Get contents
     *
     * @return \Ivoz\Provider\Domain\Model\NotificationTemplateContent\NotificationTemplateContentInterface[]
     */
    public function getContents(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->contents->matching($criteria)->toArray();
        }

        return $this->contents->toArray();
    }
}
