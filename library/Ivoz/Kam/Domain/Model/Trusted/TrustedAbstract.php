<?php
declare(strict_types = 1);

namespace Ivoz\Kam\Domain\Model\Trusted;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Company\Company;

/**
* TrustedAbstract
* @codeCoverageIgnore
*/
abstract class TrustedAbstract
{
    use ChangelogTrait;

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
     * @var int
     */
    protected $priority = 0;

    /**
     * @var CompanyInterface
     */
    protected $company;

    /**
     * Constructor
     */
    protected function __construct(
        $priority
    ) {
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
     * @param TrustedInterface|null $entity
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

        /** @var TrustedDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param TrustedDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
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
            ->setCompany($fkTransformer->transform($dto->getCompany()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param TrustedDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
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
            ->setCompany(Company::entityToDto(self::getCompany(), $depth));
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
            'companyId' => self::getCompany()->getId()
        ];
    }

    /**
     * Set srcIp
     *
     * @param string $srcIp | null
     *
     * @return static
     */
    protected function setSrcIp(?string $srcIp = null): TrustedInterface
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
    public function getSrcIp(): ?string
    {
        return $this->srcIp;
    }

    /**
     * Set proto
     *
     * @param string $proto | null
     *
     * @return static
     */
    protected function setProto(?string $proto = null): TrustedInterface
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
    public function getProto(): ?string
    {
        return $this->proto;
    }

    /**
     * Set fromPattern
     *
     * @param string $fromPattern | null
     *
     * @return static
     */
    protected function setFromPattern(?string $fromPattern = null): TrustedInterface
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
    public function getFromPattern(): ?string
    {
        return $this->fromPattern;
    }

    /**
     * Set ruriPattern
     *
     * @param string $ruriPattern | null
     *
     * @return static
     */
    protected function setRuriPattern(?string $ruriPattern = null): TrustedInterface
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
    public function getRuriPattern(): ?string
    {
        return $this->ruriPattern;
    }

    /**
     * Set tag
     *
     * @param string $tag | null
     *
     * @return static
     */
    protected function setTag(?string $tag = null): TrustedInterface
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
    public function getTag(): ?string
    {
        return $this->tag;
    }

    /**
     * Set description
     *
     * @param string $description | null
     *
     * @return static
     */
    protected function setDescription(?string $description = null): TrustedInterface
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
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Set priority
     *
     * @param int $priority
     *
     * @return static
     */
    protected function setPriority(int $priority): TrustedInterface
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
     * Set company
     *
     * @param CompanyInterface
     *
     * @return static
     */
    protected function setCompany(CompanyInterface $company): TrustedInterface
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return CompanyInterface
     */
    public function getCompany(): CompanyInterface
    {
        return $this->company;
    }

}
