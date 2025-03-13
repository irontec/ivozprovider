<?php

namespace Ivoz\Provider\Domain\Model\Recording;

use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\UsersCdr\UsersCdrInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Core\Domain\Service\TempFile;
use Ivoz\Core\Domain\Service\FileContainerInterface;

/**
* RecordingInterface
*/
interface RecordingInterface extends EntityInterface, FileContainerInterface
{
    public const TYPE_ONDEMAND = 'ondemand';

    public const TYPE_DDI = 'ddi';

    /**
     * @return array
     */
    public function getFileObjects(?int $filter = null): array;

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int;

    /**
     * @param int | null $id
     */
    public static function createDto($id = null): RecordingDto;

    /**
     * @internal use EntityTools instead
     * @param null|RecordingInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?RecordingDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param RecordingDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): RecordingDto;

    public function getCallid(): ?string;

    public function getCalldate(): \DateTime;

    public function getType(): string;

    public function getDuration(): float;

    public function getCaller(): ?string;

    public function getCallee(): ?string;

    public function getRecorder(): ?string;

    public function getRecordedFile(): RecordedFile;

    public function getUsersCdr(): ?UsersCdrInterface;

    public function setCompany(CompanyInterface $company): static;

    public function getCompany(): CompanyInterface;

    public function setDdi(?DdiInterface $ddi = null): static;

    public function getDdi(): ?DdiInterface;

    public function setUser(?UserInterface $user = null): static;

    public function getUser(): ?UserInterface;

    /**
     * @return void
     */
    public function addTmpFile(string $fldName, TempFile $file);

    /**
     * @throws \Exception
     * @return void
     */
    public function removeTmpFile(TempFile $file);

    /**
     * @return \Ivoz\Core\Domain\Service\TempFile[]
     */
    public function getTempFiles();

    /**
     * @param string $fldName
     * @return null | \Ivoz\Core\Domain\Service\TempFile
     */
    public function getTempFileByFieldName($fldName);
}
