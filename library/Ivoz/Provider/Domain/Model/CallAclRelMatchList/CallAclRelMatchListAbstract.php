<?php

namespace Ivoz\Provider\Domain\Model\CallAclRelMatchList;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * CallAclRelMatchListAbstract
 * @codeCoverageIgnore
 */
abstract class CallAclRelMatchListAbstract
{
    /**
     * @var integer
     */
    protected $priority;

    /**
     * comment: enum:allow|deny
     * @var string
     */
    protected $policy;

    /**
     * @var \Ivoz\Provider\Domain\Model\CallAcl\CallAclInterface
     */
    protected $callAcl;

    /**
     * @var \Ivoz\Provider\Domain\Model\MatchList\MatchListInterface
     */
    protected $matchList;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct($priority, $policy)
    {
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
     * @param EntityInterface|null $entity
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

        return $entity->toDto($depth-1);
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto CallAclRelMatchListDto
         */
        Assertion::isInstanceOf($dto, CallAclRelMatchListDto::class);

        $self = new static(
            $dto->getPriority(),
            $dto->getPolicy()
        );

        $self
            ->setCallAcl($dto->getCallAcl())
            ->setMatchList($dto->getMatchList())
        ;

        $self->sanitizeValues();
        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto CallAclRelMatchListDto
         */
        Assertion::isInstanceOf($dto, CallAclRelMatchListDto::class);

        $this
            ->setPriority($dto->getPriority())
            ->setPolicy($dto->getPolicy())
            ->setCallAcl($dto->getCallAcl())
            ->setMatchList($dto->getMatchList());



        $this->sanitizeValues();
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
            ->setCallAcl(\Ivoz\Provider\Domain\Model\CallAcl\CallAcl::entityToDto(self::getCallAcl(), $depth))
            ->setMatchList(\Ivoz\Provider\Domain\Model\MatchList\MatchList::entityToDto(self::getMatchList(), $depth));
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
            'matchListId' => self::getMatchList() ? self::getMatchList()->getId() : null
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * Set priority
     *
     * @param integer $priority
     *
     * @return self
     */
    protected function setPriority($priority)
    {
        Assertion::notNull($priority, 'priority value "%s" is null, but non null value was expected.');
        Assertion::integerish($priority, 'priority value "%s" is not an integer or a number castable to integer.');

        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return integer
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set policy
     *
     * @param string $policy
     *
     * @return self
     */
    protected function setPolicy($policy)
    {
        Assertion::notNull($policy, 'policy value "%s" is null, but non null value was expected.');
        Assertion::maxLength($policy, 25, 'policy value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice($policy, array (
          0 => 'allow',
          1 => 'deny',
        ), 'policyvalue "%s" is not an element of the valid values: %s');

        $this->policy = $policy;

        return $this;
    }

    /**
     * Get policy
     *
     * @return string
     */
    public function getPolicy()
    {
        return $this->policy;
    }

    /**
     * Set callAcl
     *
     * @param \Ivoz\Provider\Domain\Model\CallAcl\CallAclInterface $callAcl
     *
     * @return self
     */
    public function setCallAcl(\Ivoz\Provider\Domain\Model\CallAcl\CallAclInterface $callAcl = null)
    {
        $this->callAcl = $callAcl;

        return $this;
    }

    /**
     * Get callAcl
     *
     * @return \Ivoz\Provider\Domain\Model\CallAcl\CallAclInterface
     */
    public function getCallAcl()
    {
        return $this->callAcl;
    }

    /**
     * Set matchList
     *
     * @param \Ivoz\Provider\Domain\Model\MatchList\MatchListInterface $matchList
     *
     * @return self
     */
    public function setMatchList(\Ivoz\Provider\Domain\Model\MatchList\MatchListInterface $matchList)
    {
        $this->matchList = $matchList;

        return $this;
    }

    /**
     * Get matchList
     *
     * @return \Ivoz\Provider\Domain\Model\MatchList\MatchListInterface
     */
    public function getMatchList()
    {
        return $this->matchList;
    }

    // @codeCoverageIgnoreEnd
}
