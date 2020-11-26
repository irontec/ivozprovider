<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\ExternalCallFilterBlackList;

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
* ExternalCallFilterBlackListAbstract
* @codeCoverageIgnore
*/
abstract class ExternalCallFilterBlackListAbstract
{
    use ChangelogTrait;

    /**
     * @var ExternalCallFilterInterface
     * inversedBy blackLists
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
            "ExternalCallFilterBlackList",
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
     * @param null $id
     * @return ExternalCallFilterBlackListDto
     */
    public static function createDto($id = null)
    {
        return new ExternalCallFilterBlackListDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param ExternalCallFilterBlackListInterface|null $entity
     * @param int $depth
     * @return ExternalCallFilterBlackListDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, ExternalCallFilterBlackListInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var ExternalCallFilterBlackListDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param ExternalCallFilterBlackListDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, ExternalCallFilterBlackListDto::class);

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
     * @param ExternalCallFilterBlackListDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, ExternalCallFilterBlackListDto::class);

        $this
            ->setFilter($fkTransformer->transform($dto->getFilter()))
            ->setMatchlist($fkTransformer->transform($dto->getMatchlist()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return ExternalCallFilterBlackListDto
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

    /**
     * Set filter
     *
     * @param ExternalCallFilterInterface | null
     *
     * @return static
     */
    public function setFilter(?ExternalCallFilterInterface $filter = null): ExternalCallFilterBlackListInterface
    {
        $this->filter = $filter;

        return $this;
    }

    /**
     * Get filter
     *
     * @return ExternalCallFilterInterface | null
     */
    public function getFilter(): ?ExternalCallFilterInterface
    {
        return $this->filter;
    }

    /**
     * Set matchlist
     *
     * @param MatchListInterface
     *
     * @return static
     */
    protected function setMatchlist(MatchListInterface $matchlist): ExternalCallFilterBlackListInterface
    {
        $this->matchlist = $matchlist;

        return $this;
    }

    /**
     * Get matchlist
     *
     * @return MatchListInterface
     */
    public function getMatchlist(): MatchListInterface
    {
        return $this->matchlist;
    }

}
