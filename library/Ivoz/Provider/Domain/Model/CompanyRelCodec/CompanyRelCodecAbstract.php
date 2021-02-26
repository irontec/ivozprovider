<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\CompanyRelCodec;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Codec\CodecInterface;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Codec\Codec;

/**
* CompanyRelCodecAbstract
* @codeCoverageIgnore
*/
abstract class CompanyRelCodecAbstract
{
    use ChangelogTrait;

    /**
     * @var CompanyInterface | null
     * inversedBy relCodecs
     */
    protected $company;

    /**
     * @var CodecInterface
     */
    protected $codec;

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
     * @param mixed $id
     * @return CompanyRelCodecDto
     */
    public static function createDto($id = null)
    {
        return new CompanyRelCodecDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param CompanyRelCodecInterface|null $entity
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

        /** @var CompanyRelCodecDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param CompanyRelCodecDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, CompanyRelCodecDto::class);

        $self = new static(

        );

        $self
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setCodec($fkTransformer->transform($dto->getCodec()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param CompanyRelCodecDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, CompanyRelCodecDto::class);

        $this
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setCodec($fkTransformer->transform($dto->getCodec()));

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
            ->setCompany(Company::entityToDto(self::getCompany(), $depth))
            ->setCodec(Codec::entityToDto(self::getCodec(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'companyId' => self::getCompany() ? self::getCompany()->getId() : null,
            'codecId' => self::getCodec()->getId()
        ];
    }

    public function setCompany(?CompanyInterface $company = null): static
    {
        $this->company = $company;

        /** @var  $this */
        return $this;
    }

    public function getCompany(): ?CompanyInterface
    {
        return $this->company;
    }

    protected function setCodec(CodecInterface $codec): static
    {
        $this->codec = $codec;

        return $this;
    }

    public function getCodec(): CodecInterface
    {
        return $this->codec;
    }

}
