<?php

namespace Ivoz\Provider\Domain\Model\CompanyRelCodec;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * CompanyRelCodecAbstract
 * @codeCoverageIgnore
 */
abstract class CompanyRelCodecAbstract
{
    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    protected $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\Codec\CodecInterface
     */
    protected $codec;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct()
    {
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "CompanyRelCodec",
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
     * @return CompanyRelCodecDto
     */
    public static function createDto($id = null)
    {
        return new CompanyRelCodecDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param EntityInterface|null $entity
     * @param int $depth
     * @return CompanyRelCodecDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, CompanyRelCodecInterface::class);

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
         * @var $dto CompanyRelCodecDto
         */
        Assertion::isInstanceOf($dto, CompanyRelCodecDto::class);

        $self = new static();

        $self
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setCodec($fkTransformer->transform($dto->getCodec()))
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
         * @var $dto CompanyRelCodecDto
         */
        Assertion::isInstanceOf($dto, CompanyRelCodecDto::class);

        $this
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setCodec($fkTransformer->transform($dto->getCodec()));



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return CompanyRelCodecDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setCompany(\Ivoz\Provider\Domain\Model\Company\Company::entityToDto(self::getCompany(), $depth))
            ->setCodec(\Ivoz\Provider\Domain\Model\Codec\Codec::entityToDto(self::getCodec(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'companyId' => self::getCompany() ? self::getCompany()->getId() : null,
            'codecId' => self::getCodec() ? self::getCodec()->getId() : null
        ];
    }
    // @codeCoverageIgnoreStart

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
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set codec
     *
     * @param \Ivoz\Provider\Domain\Model\Codec\CodecInterface $codec
     *
     * @return self
     */
    public function setCodec(\Ivoz\Provider\Domain\Model\Codec\CodecInterface $codec)
    {
        $this->codec = $codec;

        return $this;
    }

    /**
     * Get codec
     *
     * @return \Ivoz\Provider\Domain\Model\Codec\CodecInterface
     */
    public function getCodec()
    {
        return $this->codec;
    }

    // @codeCoverageIgnoreEnd
}
