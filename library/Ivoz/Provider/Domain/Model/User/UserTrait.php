<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\User;

use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailInterface;
use Ivoz\Provider\Domain\Model\VoicemailRelUser\VoicemailRelUserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\Contact\ContactInterface;
use Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUserInterface;
use Ivoz\Provider\Domain\Model\QueueMember\QueueMemberInterface;
use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingInterface;
use Ivoz\Provider\Domain\Model\FaxesRelUser\FaxesRelUserInterface;
use Ivoz\Provider\Domain\Model\Recording\RecordingInterface;

/**
* @codeCoverageIgnore
*/
trait UserTrait
{
    /**
     * @var ?int
     */
    protected $id = null;

    /**
     * @var VoicemailInterface
     * mappedBy user
     */
    protected $voicemail;

    /**
     * @var Collection<array-key, VoicemailRelUserInterface> & Selectable<array-key, VoicemailRelUserInterface>
     * VoicemailRelUserInterface mappedBy user
     */
    protected $voicemailRelUsers;

    /**
     * @var ContactInterface
     * mappedBy user
     */
    protected $contact;

    /**
     * @var Collection<array-key, PickUpRelUserInterface> & Selectable<array-key, PickUpRelUserInterface>
     * PickUpRelUserInterface mappedBy user
     * orphanRemoval
     */
    protected $pickUpRelUsers;

    /**
     * @var Collection<array-key, QueueMemberInterface> & Selectable<array-key, QueueMemberInterface>
     * QueueMemberInterface mappedBy user
     */
    protected $queueMembers;

    /**
     * @var Collection<array-key, CallForwardSettingInterface> & Selectable<array-key, CallForwardSettingInterface>
     * CallForwardSettingInterface mappedBy user
     */
    protected $callForwardSettings;

    /**
     * @var Collection<array-key, FaxesRelUserInterface> & Selectable<array-key, FaxesRelUserInterface>
     * FaxesRelUserInterface mappedBy user
     */
    protected $faxesRelUsers;

    /**
     * @var Collection<array-key, RecordingInterface> & Selectable<array-key, RecordingInterface>
     * RecordingInterface mappedBy user
     */
    protected $recordings;

    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());
        $this->voicemailRelUsers = new ArrayCollection();
        $this->pickUpRelUsers = new ArrayCollection();
        $this->queueMembers = new ArrayCollection();
        $this->callForwardSettings = new ArrayCollection();
        $this->faxesRelUsers = new ArrayCollection();
        $this->recordings = new ArrayCollection();
    }

    abstract protected function sanitizeValues(): void;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param UserDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        if (!is_null($dto->getVoicemail())) {
            /** @var VoicemailInterface $entity */
            $entity = $fkTransformer->transform(
                $dto->getVoicemail()
            );
            $self->setVoicemail($entity);
        }

        $voicemailRelUsers = $dto->getVoicemailRelUsers();
        if (!is_null($voicemailRelUsers)) {

            /** @var Collection<array-key, VoicemailRelUserInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $voicemailRelUsers
            );
            $self->replaceVoicemailRelUsers($replacement);
        }

        if (!is_null($dto->getContact())) {
            /** @var ContactInterface $entity */
            $entity = $fkTransformer->transform(
                $dto->getContact()
            );
            $self->setContact($entity);
        }

        $pickUpRelUsers = $dto->getPickUpRelUsers();
        if (!is_null($pickUpRelUsers)) {

            /** @var Collection<array-key, PickUpRelUserInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $pickUpRelUsers
            );
            $self->replacePickUpRelUsers($replacement);
        }

        $queueMembers = $dto->getQueueMembers();
        if (!is_null($queueMembers)) {

            /** @var Collection<array-key, QueueMemberInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $queueMembers
            );
            $self->replaceQueueMembers($replacement);
        }

        $callForwardSettings = $dto->getCallForwardSettings();
        if (!is_null($callForwardSettings)) {

            /** @var Collection<array-key, CallForwardSettingInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $callForwardSettings
            );
            $self->replaceCallForwardSettings($replacement);
        }

        $faxesRelUsers = $dto->getFaxesRelUsers();
        if (!is_null($faxesRelUsers)) {

            /** @var Collection<array-key, FaxesRelUserInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $faxesRelUsers
            );
            $self->replaceFaxesRelUsers($replacement);
        }

        $recordings = $dto->getRecordings();
        if (!is_null($recordings)) {

            /** @var Collection<array-key, RecordingInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $recordings
            );
            $self->replaceRecordings($replacement);
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
     * @param UserDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        parent::updateFromDto($dto, $fkTransformer);
        if (!is_null($dto->getVoicemail())) {
            /** @var VoicemailInterface $entity */
            $entity = $fkTransformer->transform(
                $dto->getVoicemail()
            );
            $this->setVoicemail($entity);
        }

        $voicemailRelUsers = $dto->getVoicemailRelUsers();
        if (!is_null($voicemailRelUsers)) {

            /** @var Collection<array-key, VoicemailRelUserInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $voicemailRelUsers
            );
            $this->replaceVoicemailRelUsers($replacement);
        }

        if (!is_null($dto->getContact())) {
            /** @var ContactInterface $entity */
            $entity = $fkTransformer->transform(
                $dto->getContact()
            );
            $this->setContact($entity);
        }

        $pickUpRelUsers = $dto->getPickUpRelUsers();
        if (!is_null($pickUpRelUsers)) {

            /** @var Collection<array-key, PickUpRelUserInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $pickUpRelUsers
            );
            $this->replacePickUpRelUsers($replacement);
        }

        $queueMembers = $dto->getQueueMembers();
        if (!is_null($queueMembers)) {

            /** @var Collection<array-key, QueueMemberInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $queueMembers
            );
            $this->replaceQueueMembers($replacement);
        }

        $callForwardSettings = $dto->getCallForwardSettings();
        if (!is_null($callForwardSettings)) {

            /** @var Collection<array-key, CallForwardSettingInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $callForwardSettings
            );
            $this->replaceCallForwardSettings($replacement);
        }

        $faxesRelUsers = $dto->getFaxesRelUsers();
        if (!is_null($faxesRelUsers)) {

            /** @var Collection<array-key, FaxesRelUserInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $faxesRelUsers
            );
            $this->replaceFaxesRelUsers($replacement);
        }

        $recordings = $dto->getRecordings();
        if (!is_null($recordings)) {

            /** @var Collection<array-key, RecordingInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $recordings
            );
            $this->replaceRecordings($replacement);
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): UserDto
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

    public function setVoicemail(VoicemailInterface $voicemail): static
    {
        $this->voicemail = $voicemail;

        return $this;
    }

    public function getVoicemail(): ?VoicemailInterface
    {
        return $this->voicemail;
    }

    public function addVoicemailRelUser(VoicemailRelUserInterface $voicemailRelUser): UserInterface
    {
        $this->voicemailRelUsers->add($voicemailRelUser);

        return $this;
    }

    public function removeVoicemailRelUser(VoicemailRelUserInterface $voicemailRelUser): UserInterface
    {
        $this->voicemailRelUsers->removeElement($voicemailRelUser);

        return $this;
    }

    /**
     * @param Collection<array-key, VoicemailRelUserInterface> $voicemailRelUsers
     */
    public function replaceVoicemailRelUsers(Collection $voicemailRelUsers): UserInterface
    {
        foreach ($voicemailRelUsers as $entity) {
            $entity->setUser($this);
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

    public function setContact(ContactInterface $contact): static
    {
        $this->contact = $contact;

        return $this;
    }

    public function getContact(): ?ContactInterface
    {
        return $this->contact;
    }

    public function addPickUpRelUser(PickUpRelUserInterface $pickUpRelUser): UserInterface
    {
        $this->pickUpRelUsers->add($pickUpRelUser);

        return $this;
    }

    public function removePickUpRelUser(PickUpRelUserInterface $pickUpRelUser): UserInterface
    {
        $this->pickUpRelUsers->removeElement($pickUpRelUser);

        return $this;
    }

    /**
     * @param Collection<array-key, PickUpRelUserInterface> $pickUpRelUsers
     */
    public function replacePickUpRelUsers(Collection $pickUpRelUsers): UserInterface
    {
        foreach ($pickUpRelUsers as $entity) {
            $entity->setUser($this);
        }

        $toStringCallable = fn(mixed $val): \Stringable|string => $val instanceof \Stringable ? $val : serialize($val);
        foreach ($this->pickUpRelUsers as $key => $entity) {
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
            foreach ($pickUpRelUsers as $newKey => $newEntity) {
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
                    unset($pickUpRelUsers[$newKey]);
                    $match = true;
                    break;
                }
            }

            if (!$match) {
                $this->pickUpRelUsers->remove($key);
            }
        }

        foreach ($pickUpRelUsers as $entity) {
            $this->addPickUpRelUser($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, PickUpRelUserInterface>
     */
    public function getPickUpRelUsers(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->pickUpRelUsers->matching($criteria)->toArray();
        }

        return $this->pickUpRelUsers->toArray();
    }

    public function addQueueMember(QueueMemberInterface $queueMember): UserInterface
    {
        $this->queueMembers->add($queueMember);

        return $this;
    }

    public function removeQueueMember(QueueMemberInterface $queueMember): UserInterface
    {
        $this->queueMembers->removeElement($queueMember);

        return $this;
    }

    /**
     * @param Collection<array-key, QueueMemberInterface> $queueMembers
     */
    public function replaceQueueMembers(Collection $queueMembers): UserInterface
    {
        foreach ($queueMembers as $entity) {
            $entity->setUser($this);
        }

        $toStringCallable = fn(mixed $val): \Stringable|string => $val instanceof \Stringable ? $val : serialize($val);
        foreach ($this->queueMembers as $key => $entity) {
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
            foreach ($queueMembers as $newKey => $newEntity) {
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
                    unset($queueMembers[$newKey]);
                    $match = true;
                    break;
                }
            }

            if (!$match) {
                $this->queueMembers->remove($key);
            }
        }

        foreach ($queueMembers as $entity) {
            $this->addQueueMember($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, QueueMemberInterface>
     */
    public function getQueueMembers(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->queueMembers->matching($criteria)->toArray();
        }

        return $this->queueMembers->toArray();
    }

    public function addCallForwardSetting(CallForwardSettingInterface $callForwardSetting): UserInterface
    {
        $this->callForwardSettings->add($callForwardSetting);

        return $this;
    }

    public function removeCallForwardSetting(CallForwardSettingInterface $callForwardSetting): UserInterface
    {
        $this->callForwardSettings->removeElement($callForwardSetting);

        return $this;
    }

    /**
     * @param Collection<array-key, CallForwardSettingInterface> $callForwardSettings
     */
    public function replaceCallForwardSettings(Collection $callForwardSettings): UserInterface
    {
        foreach ($callForwardSettings as $entity) {
            $entity->setUser($this);
        }

        $toStringCallable = fn(mixed $val): \Stringable|string => $val instanceof \Stringable ? $val : serialize($val);
        foreach ($this->callForwardSettings as $key => $entity) {
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
            foreach ($callForwardSettings as $newKey => $newEntity) {
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
                    unset($callForwardSettings[$newKey]);
                    $match = true;
                    break;
                }
            }

            if (!$match) {
                $this->callForwardSettings->remove($key);
            }
        }

        foreach ($callForwardSettings as $entity) {
            $this->addCallForwardSetting($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, CallForwardSettingInterface>
     */
    public function getCallForwardSettings(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->callForwardSettings->matching($criteria)->toArray();
        }

        return $this->callForwardSettings->toArray();
    }

    public function addFaxesRelUser(FaxesRelUserInterface $faxesRelUser): UserInterface
    {
        $this->faxesRelUsers->add($faxesRelUser);

        return $this;
    }

    public function removeFaxesRelUser(FaxesRelUserInterface $faxesRelUser): UserInterface
    {
        $this->faxesRelUsers->removeElement($faxesRelUser);

        return $this;
    }

    /**
     * @param Collection<array-key, FaxesRelUserInterface> $faxesRelUsers
     */
    public function replaceFaxesRelUsers(Collection $faxesRelUsers): UserInterface
    {
        foreach ($faxesRelUsers as $entity) {
            $entity->setUser($this);
        }

        $toStringCallable = fn(mixed $val): \Stringable|string => $val instanceof \Stringable ? $val : serialize($val);
        foreach ($this->faxesRelUsers as $key => $entity) {
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
            foreach ($faxesRelUsers as $newKey => $newEntity) {
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
                    unset($faxesRelUsers[$newKey]);
                    $match = true;
                    break;
                }
            }

            if (!$match) {
                $this->faxesRelUsers->remove($key);
            }
        }

        foreach ($faxesRelUsers as $entity) {
            $this->addFaxesRelUser($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, FaxesRelUserInterface>
     */
    public function getFaxesRelUsers(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->faxesRelUsers->matching($criteria)->toArray();
        }

        return $this->faxesRelUsers->toArray();
    }

    public function addRecording(RecordingInterface $recording): UserInterface
    {
        $recording->setUser($this);
        $this->recordings->add($recording);

        return $this;
    }

    public function removeRecording(RecordingInterface $recording): UserInterface
    {
        $recording->setUser(null);

        return $this;
    }

    /**
     * @param Collection<array-key, RecordingInterface> $recordings
     */
    public function replaceRecordings(Collection $recordings): UserInterface
    {
        foreach ($recordings as $entity) {
            $entity->setUser($this);
        }

        $toStringCallable = fn(mixed $val): \Stringable|string => $val instanceof \Stringable ? $val : serialize($val);
        foreach ($this->recordings as $key => $entity) {
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
            foreach ($recordings as $newKey => $newEntity) {
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
                    unset($recordings[$newKey]);
                    $match = true;
                    break;
                }
            }

            if (!$match) {
                $this->recordings[$key]?->setUser(null);
            }
        }

        foreach ($recordings as $entity) {
            $this->addRecording($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, RecordingInterface>
     */
    public function getRecordings(Criteria $criteria = null): array
    {
        /** @var ArrayCollection<int, RecordingInterface> $recordings */
        $recordings = $this->recordings->matching(
            Criteria::create()
                ->where(
                    Criteria::expr()
                        ->neq('user', null)
                ),
        );

        if (!is_null($criteria)) {
            return $recordings->matching($criteria)->toArray();
        }

        return $recordings->toArray();
    }
}
