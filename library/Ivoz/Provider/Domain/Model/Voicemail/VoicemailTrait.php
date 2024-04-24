<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\Voicemail;

use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Ast\Domain\Model\Voicemail\VoicemailInterface;
use Ivoz\Provider\Domain\Model\VoicemailRelUser\VoicemailRelUserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Collections\Criteria;

/**
* @codeCoverageIgnore
*/
trait VoicemailTrait
{
    /**
     * @var ?int
     */
    protected $id = null;

    /**
     * @var VoicemailInterface
     * mappedBy voicemail
     */
    protected $astVoicemail;

    /**
     * @var Collection<array-key, VoicemailRelUserInterface> & Selectable<array-key, VoicemailRelUserInterface>
     * VoicemailRelUserInterface mappedBy voicemail
     */
    protected $voicemailRelUsers;

    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());
        $this->voicemailRelUsers = new ArrayCollection();
    }

    abstract protected function sanitizeValues(): void;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param VoicemailDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        if (!is_null($dto->getAstVoicemail())) {
            /** @var VoicemailInterface $entity */
            $entity = $fkTransformer->transform(
                $dto->getAstVoicemail()
            );
            $self->setAstVoicemail($entity);
        }

        $voicemailRelUsers = $dto->getVoicemailRelUsers();
        if (!is_null($voicemailRelUsers)) {

            /** @var Collection<array-key, VoicemailRelUserInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $voicemailRelUsers
            );
            $self->replaceVoicemailRelUsers($replacement);
        }

        $self->sanitizeValues();
        if ($dto->getId()) {
            $self->id = $dto->getId();
            $self->initChangelog();
        }

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param VoicemailDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        parent::updateFromDto($dto, $fkTransformer);
        if (!is_null($dto->getAstVoicemail())) {
            /** @var VoicemailInterface $entity */
            $entity = $fkTransformer->transform(
                $dto->getAstVoicemail()
            );
            $this->setAstVoicemail($entity);
        }

        $voicemailRelUsers = $dto->getVoicemailRelUsers();
        if (!is_null($voicemailRelUsers)) {

            /** @var Collection<array-key, VoicemailRelUserInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $voicemailRelUsers
            );
            $this->replaceVoicemailRelUsers($replacement);
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): VoicemailDto
    {
        $dto = parent::toDto($depth);
        return $dto
            ->setId($this->getId());
    }

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
    {
        return parent::__toArray() + [
            'id' => self::getId()
        ];
    }

    public function setAstVoicemail(VoicemailInterface $astVoicemail): static
    {
        $this->astVoicemail = $astVoicemail;

        return $this;
    }

    public function getAstVoicemail(): ?VoicemailInterface
    {
        return $this->astVoicemail;
    }

    public function addVoicemailRelUser(VoicemailRelUserInterface $voicemailRelUser): static
    {
        $this->voicemailRelUsers->add($voicemailRelUser);

        return $this;
    }

    public function removeVoicemailRelUser(VoicemailRelUserInterface $voicemailRelUser): static
    {
        $this->voicemailRelUsers->removeElement($voicemailRelUser);

        return $this;
    }

    /**
     * @param Collection<array-key, VoicemailRelUserInterface> $voicemailRelUsers
     */
    public function replaceVoicemailRelUsers(Collection $voicemailRelUsers): static
    {
        foreach ($voicemailRelUsers as $entity) {
            $entity->setVoicemail($this);
        }

        $toStringCallable = fn(mixed $val): \Stringable|string => $val instanceof \Stringable ? $val : serialize($val);
        foreach ($this->voicemailRelUsers as $key => $entity) {
            /**
             * @psalm-suppress MixedArgument
             */
            $currentValue = array_map(
                $toStringCallable,
                (function (): array {
                    return $this->__toArray(); /** @phpstan-ignore-line */
                })->call($entity)
            );

            $match = false;
            foreach ($voicemailRelUsers as $newKey => $newEntity) {
                /**
                 * @psalm-suppress MixedArgument
                 */
                $newValue = array_map(
                    $toStringCallable,
                    (function (): array {
                        return $this->__toArray(); /** @phpstan-ignore-line */
                    })->call($newEntity)
                );

                $diff = array_diff_assoc(
                    $currentValue,
                    $newValue
                );
                unset($diff['id']);

                if (empty($diff)) {
                    unset($voicemailRelUsers[$newKey]);
                    $match = true;
                    break;
                }
            }

            if (!$match) {
                $this->voicemailRelUsers->remove($key);
            }
        }

        foreach ($voicemailRelUsers as $entity) {
            $this->addVoicemailRelUser($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, VoicemailRelUserInterface>
     */
    public function getVoicemailRelUsers(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->voicemailRelUsers->matching($criteria)->toArray();
        }

        return $this->voicemailRelUsers->toArray();
    }
}
