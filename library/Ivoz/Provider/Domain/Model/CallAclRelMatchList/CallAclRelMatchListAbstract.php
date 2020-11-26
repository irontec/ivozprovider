<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\CallAclRelMatchList;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\CallAcl\CallAclInterface;
use Ivoz\Provider\Domain\Model\MatchList\MatchListInterface;
use Ivoz\Provider\Domain\Model\CallAcl\CallAcl;
use Ivoz\Provider\Domain\Model\MatchList\MatchList;

/**
* CallAclRelMatchListAbstract
* @codeCoverageIgnore
*/
abstract class CallAclRelMatchListAbstract
{
    use ChangelogTrait;

    /**
     * @var int
     */
    protected $priority;

    /**
     * comment: enum:allow|deny
     * @var string
     */
    protected $policy;

    /**
     * @var CallAclInterface
     * inversedBy relMatchLists
     */
    protected $callAcl;

    /**
     * @var MatchListInterface
     */
    protected $matchList;

    /**
     * Constructor
     */
    protected function __construct(
        $priority,
        $policy
    ) {
        $this->setPriority($priority);
        $this->setPolicy($policy);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "CallAclRelMatchList",
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
     * @return CallAclRelMatchListDto
     */
    public static function createDto($id = null)
    {
        return new CallAclRelMatchListDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param CallAclRelMatchListInterface|null $entity
     * @param int $depth
     * @return CallAclRelMatchListDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, CallAclRelMatchListInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var CallAclRelMatchListDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param CallAclRelMatchListDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, CallAclRelMatchListDto::class);

        $self = new static(
            $dto->getPriority(),
            $dto->getPolicy()
        );

        $self
            ->setCallAcl($fkTransformer->transform($dto->getCallAcl()))
            ->setMatchList($fkTransformer->transform($dto->getMatchList()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param CallAclRelMatchListDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, CallAclRelMatchListDto::class);

        $this
            ->setPriority($dto->getPriority())
            ->setPolicy($dto->getPolicy())
            ->setCallAcl($fkTransformer->transform($dto->getCallAcl()))
            ->setMatchList($fkTransformer->transform($dto->getMatchList()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return CallAclRelMatchListDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setPriority(self::getPriority())
            ->setPolicy(self::getPolicy())
            ->setCallAcl(CallAcl::entityToDto(self::getCallAcl(), $depth))
            ->setMatchList(MatchList::entityToDto(self::getMatchList(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'priority' => self::getPriority(),
            'policy' => self::getPolicy(),
            'callAclId' => self::getCallAcl() ? self::getCallAcl()->getId() : null,
            'matchListId' => self::getMatchList()->getId()
        ];
    }

    /**
     * Set priority
     *
     * @param int $priority
     *
     * @return static
     */
    protected function setPriority(int $priority): CallAclRelMatchListInterface
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * Set policy
     *
     * @param string $policy
     *
     * @return static
     */
    protected function setPolicy(string $policy): CallAclRelMatchListInterface
    {
        Assertion::maxLength($policy, 25, 'policy value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice(
            $policy,
            [
                CallAclRelMatchListInterface::POLICY_ALLOW,
                CallAclRelMatchListInterface::POLICY_DENY,
            ],
            'policyvalue "%s" is not an element of the valid values: %s'
        );

        $this->policy = $policy;

        return $this;
    }

    /**
     * Get policy
     *
     * @return string
     */
    public function getPolicy(): string
    {
        return $this->policy;
    }

    /**
     * Set callAcl
     *
     * @param CallAclInterface | null
     *
     * @return static
     */
    public function setCallAcl(?CallAclInterface $callAcl = null): CallAclRelMatchListInterface
    {
        $this->callAcl = $callAcl;

        return $this;
    }

    /**
     * Get callAcl
     *
     * @return CallAclInterface | null
     */
    public function getCallAcl(): ?CallAclInterface
    {
        return $this->callAcl;
    }

    /**
     * Set matchList
     *
     * @param MatchListInterface
     *
     * @return static
     */
    protected function setMatchList(MatchListInterface $matchList): CallAclRelMatchListInterface
    {
        $this->matchList = $matchList;

        return $this;
    }

    /**
     * Get matchList
     *
     * @return MatchListInterface
     */
    public function getMatchList(): MatchListInterface
    {
        return $this->matchList;
    }

}
