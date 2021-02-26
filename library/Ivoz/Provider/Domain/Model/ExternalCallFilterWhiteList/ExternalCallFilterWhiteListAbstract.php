<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\ExternalCallFilterWhiteList;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterInterface;
use Ivoz\Provider\Domain\Model\MatchList\MatchListInterface;
use Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilter;
use Ivoz\Provider\Domain\Model\MatchList\MatchList;

/**
* ExternalCallFilterWhiteListAbstract
* @codeCoverageIgnore
*/
abstract class ExternalCallFilterWhiteListAbstract
{
    use ChangelogTrait;

    /**
     * @var ExternalCallFilterInterface | null
     * inversedBy whiteLists
     */
    protected $filter;

    /**
     * @var MatchListInterface
     */
    protected $matchlist;

    /**
     * Constructor
     */
    protected function __construct(

    ) {

    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "ExternalCallFilterWhiteList",
            $this->getId()
        );
    }

    /**
     * @return void
     * @throws \Exception
     */
    protected function sanitizeValues()
    {
    }

    /**
     * @param mixed $id
     * @return ExternalCallFilterWhiteListDto
     */
    public static function createDto($id = null)
    {
        return new ExternalCallFilterWhiteListDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param ExternalCallFilterWhiteListInterface|null $entity
     * @param int $depth
     * @return ExternalCallFilterWhiteListDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, ExternalCallFilterWhiteListInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var ExternalCallFilterWhiteListDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param ExternalCallFilterWhiteListDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, ExternalCallFilterWhiteListDto::class);

        $self = new static(

        );

        $self
            ->setFilter($fkTransformer->transform($dto->getFilter()))
            ->setMatchlist($fkTransformer->transform($dto->getMatchlist()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param ExternalCallFilterWhiteListDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, ExternalCallFilterWhiteListDto::class);

        $this
            ->setFilter($fkTransformer->transform($dto->getFilter()))
            ->setMatchlist($fkTransformer->transform($dto->getMatchlist()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return ExternalCallFilterWhiteListDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setFilter(ExternalCallFilter::entityToDto(self::getFilter(), $depth))
            ->setMatchlist(MatchList::entityToDto(self::getMatchlist(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'filterId' => self::getFilter() ? self::getFilter()->getId() : null,
            'matchlistId' => self::getMatchlist()->getId()
        ];
    }

    public function setFilter(?ExternalCallFilterInterface $filter = null): static
    {
        $this->filter = $filter;

        /** @var  $this */
        return $this;
    }

    public function getFilter(): ?ExternalCallFilterInterface
    {
        return $this->filter;
    }

    protected function setMatchlist(MatchListInterface $matchlist): static
    {
        $this->matchlist = $matchlist;

        return $this;
    }

    public function getMatchlist(): MatchListInterface
    {
        return $this->matchlist;
    }

}
