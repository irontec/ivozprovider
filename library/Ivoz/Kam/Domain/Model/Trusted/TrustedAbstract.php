<?php

namespace Ivoz\Kam\Domain\Model\Trusted;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * TrustedAbstract
 * @codeCoverageIgnore
 */
abstract class TrustedAbstract
{
    /**
     * column: src_ip
     * @var string | null
     */
    protected $srcIp;

    /**
     * @var string | null
     */
    protected $proto;

    /**
     * column: from_pattern
     * @var string | null
     */
    protected $fromPattern;

    /**
     * column: ruri_pattern
     * @var string | null
     */
    protected $ruriPattern;

    /**
     * @var string | null
     */
    protected $tag;

    /**
     * @var string | null
     */
    protected $description;

    /**
     * @var integer
     */
    protected $priority = '0';

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    protected $company;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct($priority)
    {
        $this->setPriority($priority);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "Trusted",
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
     * @return TrustedDto
     */
    public static function createDto($id = null)
    {
        return new TrustedDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param EntityInterface|null $entity
     * @param int $depth
     * @return TrustedDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, TrustedInterface::class);

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
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /**
         * @var $dto TrustedDto
         */
        Assertion::isInstanceOf($dto, TrustedDto::class);

        $self = new static(
            $dto->getPriority()
        );

        $self
            ->setSrcIp($dto->getSrcIp())
            ->setProto($dto->getProto())
            ->setFromPattern($dto->getFromPattern())
            ->setRuriPattern($dto->getRuriPattern())
            ->setTag($dto->getTag())
            ->setDescription($dto->getDescription())
            ->setCompany($fkTransformer->transform($dto->getCompany()))
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
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /**
         * @var $dto TrustedDto
         */
        Assertion::isInstanceOf($dto, TrustedDto::class);

        $this
            ->setSrcIp($dto->getSrcIp())
            ->setProto($dto->getProto())
            ->setFromPattern($dto->getFromPattern())
            ->setRuriPattern($dto->getRuriPattern())
            ->setTag($dto->getTag())
            ->setDescription($dto->getDescription())
            ->setPriority($dto->getPriority())
            ->setCompany($fkTransformer->transform($dto->getCompany()));



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return TrustedDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setSrcIp(self::getSrcIp())
            ->setProto(self::getProto())
            ->setFromPattern(self::getFromPattern())
            ->setRuriPattern(self::getRuriPattern())
            ->setTag(self::getTag())
            ->setDescription(self::getDescription())
            ->setPriority(self::getPriority())
            ->setCompany(\Ivoz\Provider\Domain\Model\Company\Company::entityToDto(self::getCompany(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'src_ip' => self::getSrcIp(),
            'proto' => self::getProto(),
            'from_pattern' => self::getFromPattern(),
            'ruri_pattern' => self::getRuriPattern(),
            'tag' => self::getTag(),
            'description' => self::getDescription(),
            'priority' => self::getPriority(),
            'companyId' => self::getCompany() ? self::getCompany()->getId() : null
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * Set srcIp
     *
     * @param string $srcIp
     *
     * @return self
     */
    protected function setSrcIp($srcIp = null)
    {
        if (!is_null($srcIp)) {
            Assertion::maxLength($srcIp, 50, 'srcIp value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->srcIp = $srcIp;

        return $this;
    }

    /**
     * Get srcIp
     *
     * @return string | null
     */
    public function getSrcIp()
    {
        return $this->srcIp;
    }

    /**
     * Set proto
     *
     * @param string $proto
     *
     * @return self
     */
    protected function setProto($proto = null)
    {
        if (!is_null($proto)) {
            Assertion::maxLength($proto, 4, 'proto value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->proto = $proto;

        return $this;
    }

    /**
     * Get proto
     *
     * @return string | null
     */
    public function getProto()
    {
        return $this->proto;
    }

    /**
     * Set fromPattern
     *
     * @param string $fromPattern
     *
     * @return self
     */
    protected function setFromPattern($fromPattern = null)
    {
        if (!is_null($fromPattern)) {
            Assertion::maxLength($fromPattern, 64, 'fromPattern value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->fromPattern = $fromPattern;

        return $this;
    }

    /**
     * Get fromPattern
     *
     * @return string | null
     */
    public function getFromPattern()
    {
        return $this->fromPattern;
    }

    /**
     * Set ruriPattern
     *
     * @param string $ruriPattern
     *
     * @return self
     */
    protected function setRuriPattern($ruriPattern = null)
    {
        if (!is_null($ruriPattern)) {
            Assertion::maxLength($ruriPattern, 64, 'ruriPattern value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->ruriPattern = $ruriPattern;

        return $this;
    }

    /**
     * Get ruriPattern
     *
     * @return string | null
     */
    public function getRuriPattern()
    {
        return $this->ruriPattern;
    }

    /**
     * Set tag
     *
     * @param string $tag
     *
     * @return self
     */
    protected function setTag($tag = null)
    {
        if (!is_null($tag)) {
            Assertion::maxLength($tag, 64, 'tag value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return string | null
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return self
     */
    protected function setDescription($description = null)
    {
        if (!is_null($description)) {
            Assertion::maxLength($description, 200, 'description value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string | null
     */
    public function getDescription()
    {
        return $this->description;
    }

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
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return self
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface | null
     */
    public function getCompany()
    {
        return $this->company;
    }

    // @codeCoverageIgnoreEnd
}
