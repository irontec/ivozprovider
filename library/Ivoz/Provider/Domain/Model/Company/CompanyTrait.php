<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\Company;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\Friend\FriendInterface;
use Ivoz\Provider\Domain\Model\Contact\ContactInterface;
use Ivoz\Provider\Domain\Model\CompanyService\CompanyServiceInterface;
use Ivoz\Provider\Domain\Model\Terminal\TerminalInterface;
use Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface;
use Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHoldInterface;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailInterface;
use Ivoz\Provider\Domain\Model\Recording\RecordingInterface;
use Ivoz\Provider\Domain\Model\FeaturesRelCompany\FeaturesRelCompanyInterface;
use Ivoz\Provider\Domain\Model\CompanyRelGeoIPCountry\CompanyRelGeoIPCountryInterface;
use Ivoz\Provider\Domain\Model\CompanyRelCodec\CompanyRelCodecInterface;
use Ivoz\Provider\Domain\Model\CompanyRelRoutingTag\CompanyRelRoutingTagInterface;

/**
* @codeCoverageIgnore
*/
trait CompanyTrait
{
    /**
     * @var ?int
     */
    protected $id = null;

    /**
     * @var Collection<array-key, ExtensionInterface> & Selectable<array-key, ExtensionInterface>
     * ExtensionInterface mappedBy company
     */
    protected $extensions;

    /**
     * @var Collection<array-key, DdiInterface> & Selectable<array-key, DdiInterface>
     * DdiInterface mappedBy company
     */
    protected $ddis;

    /**
     * @var Collection<array-key, FriendInterface> & Selectable<array-key, FriendInterface>
     * FriendInterface mappedBy company
     */
    protected $friends;

    /**
     * @var Collection<array-key, ContactInterface> & Selectable<array-key, ContactInterface>
     * ContactInterface mappedBy company
     */
    protected $contacts;

    /**
     * @var Collection<array-key, CompanyServiceInterface> & Selectable<array-key, CompanyServiceInterface>
     * CompanyServiceInterface mappedBy company
     */
    protected $companyServices;

    /**
     * @var Collection<array-key, TerminalInterface> & Selectable<array-key, TerminalInterface>
     * TerminalInterface mappedBy company
     */
    protected $terminals;

    /**
     * @var Collection<array-key, RatingProfileInterface> & Selectable<array-key, RatingProfileInterface>
     * RatingProfileInterface mappedBy company
     */
    protected $ratingProfiles;

    /**
     * @var Collection<array-key, MusicOnHoldInterface> & Selectable<array-key, MusicOnHoldInterface>
     * MusicOnHoldInterface mappedBy company
     */
    protected $musicsOnHold;

    /**
     * @var Collection<array-key, VoicemailInterface> & Selectable<array-key, VoicemailInterface>
     * VoicemailInterface mappedBy company
     */
    protected $voicemails;

    /**
     * @var Collection<array-key, RecordingInterface> & Selectable<array-key, RecordingInterface>
     * RecordingInterface mappedBy company
     */
    protected $recordings;

    /**
     * @var Collection<array-key, FeaturesRelCompanyInterface> & Selectable<array-key, FeaturesRelCompanyInterface>
     * FeaturesRelCompanyInterface mappedBy company
     * orphanRemoval
     */
    protected $relFeatures;

    /**
     * @var Collection<array-key, CompanyRelGeoIPCountryInterface> & Selectable<array-key, CompanyRelGeoIPCountryInterface>
     * CompanyRelGeoIPCountryInterface mappedBy company
     * orphanRemoval
     */
    protected $relCountries;

    /**
     * @var Collection<array-key, CompanyRelCodecInterface> & Selectable<array-key, CompanyRelCodecInterface>
     * CompanyRelCodecInterface mappedBy company
     * orphanRemoval
     */
    protected $relCodecs;

    /**
     * @var Collection<array-key, CompanyRelRoutingTagInterface> & Selectable<array-key, CompanyRelRoutingTagInterface>
     * CompanyRelRoutingTagInterface mappedBy company
     * orphanRemoval
     */
    protected $relRoutingTags;

    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());
        $this->extensions = new ArrayCollection();
        $this->ddis = new ArrayCollection();
        $this->friends = new ArrayCollection();
        $this->contacts = new ArrayCollection();
        $this->companyServices = new ArrayCollection();
        $this->terminals = new ArrayCollection();
        $this->ratingProfiles = new ArrayCollection();
        $this->musicsOnHold = new ArrayCollection();
        $this->voicemails = new ArrayCollection();
        $this->recordings = new ArrayCollection();
        $this->relFeatures = new ArrayCollection();
        $this->relCountries = new ArrayCollection();
        $this->relCodecs = new ArrayCollection();
        $this->relRoutingTags = new ArrayCollection();
    }

    abstract protected function sanitizeValues(): void;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param CompanyDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        $extensions = $dto->getExtensions();
        if (!is_null($extensions)) {

            /** @var Collection<array-key, ExtensionInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $extensions
            );
            $self->replaceExtensions($replacement);
        }

        $ddis = $dto->getDdis();
        if (!is_null($ddis)) {

            /** @var Collection<array-key, DdiInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $ddis
            );
            $self->replaceDdis($replacement);
        }

        $friends = $dto->getFriends();
        if (!is_null($friends)) {

            /** @var Collection<array-key, FriendInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $friends
            );
            $self->replaceFriends($replacement);
        }

        $contacts = $dto->getContacts();
        if (!is_null($contacts)) {

            /** @var Collection<array-key, ContactInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $contacts
            );
            $self->replaceContacts($replacement);
        }

        $companyServices = $dto->getCompanyServices();
        if (!is_null($companyServices)) {

            /** @var Collection<array-key, CompanyServiceInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $companyServices
            );
            $self->replaceCompanyServices($replacement);
        }

        $terminals = $dto->getTerminals();
        if (!is_null($terminals)) {

            /** @var Collection<array-key, TerminalInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $terminals
            );
            $self->replaceTerminals($replacement);
        }

        $ratingProfiles = $dto->getRatingProfiles();
        if (!is_null($ratingProfiles)) {

            /** @var Collection<array-key, RatingProfileInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $ratingProfiles
            );
            $self->replaceRatingProfiles($replacement);
        }

        $musicsOnHold = $dto->getMusicsOnHold();
        if (!is_null($musicsOnHold)) {

            /** @var Collection<array-key, MusicOnHoldInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $musicsOnHold
            );
            $self->replaceMusicsOnHold($replacement);
        }

        $voicemails = $dto->getVoicemails();
        if (!is_null($voicemails)) {

            /** @var Collection<array-key, VoicemailInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $voicemails
            );
            $self->replaceVoicemails($replacement);
        }

        $recordings = $dto->getRecordings();
        if (!is_null($recordings)) {

            /** @var Collection<array-key, RecordingInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $recordings
            );
            $self->replaceRecordings($replacement);
        }

        $relFeatures = $dto->getRelFeatures();
        if (!is_null($relFeatures)) {

            /** @var Collection<array-key, FeaturesRelCompanyInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $relFeatures
            );
            $self->replaceRelFeatures($replacement);
        }

        $relCountries = $dto->getRelCountries();
        if (!is_null($relCountries)) {

            /** @var Collection<array-key, CompanyRelGeoIPCountryInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $relCountries
            );
            $self->replaceRelCountries($replacement);
        }

        $relCodecs = $dto->getRelCodecs();
        if (!is_null($relCodecs)) {

            /** @var Collection<array-key, CompanyRelCodecInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $relCodecs
            );
            $self->replaceRelCodecs($replacement);
        }

        $relRoutingTags = $dto->getRelRoutingTags();
        if (!is_null($relRoutingTags)) {

            /** @var Collection<array-key, CompanyRelRoutingTagInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $relRoutingTags
            );
            $self->replaceRelRoutingTags($replacement);
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
     * @param CompanyDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        parent::updateFromDto($dto, $fkTransformer);
        $extensions = $dto->getExtensions();
        if (!is_null($extensions)) {

            /** @var Collection<array-key, ExtensionInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $extensions
            );
            $this->replaceExtensions($replacement);
        }

        $ddis = $dto->getDdis();
        if (!is_null($ddis)) {

            /** @var Collection<array-key, DdiInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $ddis
            );
            $this->replaceDdis($replacement);
        }

        $friends = $dto->getFriends();
        if (!is_null($friends)) {

            /** @var Collection<array-key, FriendInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $friends
            );
            $this->replaceFriends($replacement);
        }

        $contacts = $dto->getContacts();
        if (!is_null($contacts)) {

            /** @var Collection<array-key, ContactInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $contacts
            );
            $this->replaceContacts($replacement);
        }

        $companyServices = $dto->getCompanyServices();
        if (!is_null($companyServices)) {

            /** @var Collection<array-key, CompanyServiceInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $companyServices
            );
            $this->replaceCompanyServices($replacement);
        }

        $terminals = $dto->getTerminals();
        if (!is_null($terminals)) {

            /** @var Collection<array-key, TerminalInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $terminals
            );
            $this->replaceTerminals($replacement);
        }

        $ratingProfiles = $dto->getRatingProfiles();
        if (!is_null($ratingProfiles)) {

            /** @var Collection<array-key, RatingProfileInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $ratingProfiles
            );
            $this->replaceRatingProfiles($replacement);
        }

        $musicsOnHold = $dto->getMusicsOnHold();
        if (!is_null($musicsOnHold)) {

            /** @var Collection<array-key, MusicOnHoldInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $musicsOnHold
            );
            $this->replaceMusicsOnHold($replacement);
        }

        $voicemails = $dto->getVoicemails();
        if (!is_null($voicemails)) {

            /** @var Collection<array-key, VoicemailInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $voicemails
            );
            $this->replaceVoicemails($replacement);
        }

        $recordings = $dto->getRecordings();
        if (!is_null($recordings)) {

            /** @var Collection<array-key, RecordingInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $recordings
            );
            $this->replaceRecordings($replacement);
        }

        $relFeatures = $dto->getRelFeatures();
        if (!is_null($relFeatures)) {

            /** @var Collection<array-key, FeaturesRelCompanyInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $relFeatures
            );
            $this->replaceRelFeatures($replacement);
        }

        $relCountries = $dto->getRelCountries();
        if (!is_null($relCountries)) {

            /** @var Collection<array-key, CompanyRelGeoIPCountryInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $relCountries
            );
            $this->replaceRelCountries($replacement);
        }

        $relCodecs = $dto->getRelCodecs();
        if (!is_null($relCodecs)) {

            /** @var Collection<array-key, CompanyRelCodecInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $relCodecs
            );
            $this->replaceRelCodecs($replacement);
        }

        $relRoutingTags = $dto->getRelRoutingTags();
        if (!is_null($relRoutingTags)) {

            /** @var Collection<array-key, CompanyRelRoutingTagInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $relRoutingTags
            );
            $this->replaceRelRoutingTags($replacement);
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): CompanyDto
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

    public function addExtension(ExtensionInterface $extension): CompanyInterface
    {
        $this->extensions->add($extension);

        return $this;
    }

    public function removeExtension(ExtensionInterface $extension): CompanyInterface
    {
        $this->extensions->removeElement($extension);

        return $this;
    }

    /**
     * @param Collection<array-key, ExtensionInterface> $extensions
     */
    public function replaceExtensions(Collection $extensions): CompanyInterface
    {
        foreach ($extensions as $entity) {
            $entity->setCompany($this);
        }

        $toStringCallable = fn(mixed $val): \Stringable|string => $val instanceof \Stringable ? $val : serialize($val);
        foreach ($this->extensions as $key => $entity) {
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
            foreach ($extensions as $newKey => $newEntity) {
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
                    unset($extensions[$newKey]);
                    $match = true;
                    break;
                }
            }

            if (!$match) {
                $this->extensions->remove($key);
            }
        }

        foreach ($extensions as $entity) {
            $this->addExtension($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, ExtensionInterface>
     */
    public function getExtensions(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->extensions->matching($criteria)->toArray();
        }

        return $this->extensions->toArray();
    }

    public function addDdi(DdiInterface $ddi): CompanyInterface
    {
        $this->ddis->add($ddi);

        return $this;
    }

    public function removeDdi(DdiInterface $ddi): CompanyInterface
    {
        $this->ddis->removeElement($ddi);

        return $this;
    }

    /**
     * @param Collection<array-key, DdiInterface> $ddis
     */
    public function replaceDdis(Collection $ddis): CompanyInterface
    {
        foreach ($ddis as $entity) {
            $entity->setCompany($this);
        }

        $toStringCallable = fn(mixed $val): \Stringable|string => $val instanceof \Stringable ? $val : serialize($val);
        foreach ($this->ddis as $key => $entity) {
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
            foreach ($ddis as $newKey => $newEntity) {
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
                    unset($ddis[$newKey]);
                    $match = true;
                    break;
                }
            }

            if (!$match) {
                $this->ddis->remove($key);
            }
        }

        foreach ($ddis as $entity) {
            $this->addDdi($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, DdiInterface>
     */
    public function getDdis(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->ddis->matching($criteria)->toArray();
        }

        return $this->ddis->toArray();
    }

    public function addFriend(FriendInterface $friend): CompanyInterface
    {
        $this->friends->add($friend);

        return $this;
    }

    public function removeFriend(FriendInterface $friend): CompanyInterface
    {
        $this->friends->removeElement($friend);

        return $this;
    }

    /**
     * @param Collection<array-key, FriendInterface> $friends
     */
    public function replaceFriends(Collection $friends): CompanyInterface
    {
        foreach ($friends as $entity) {
            $entity->setCompany($this);
        }

        $toStringCallable = fn(mixed $val): \Stringable|string => $val instanceof \Stringable ? $val : serialize($val);
        foreach ($this->friends as $key => $entity) {
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
            foreach ($friends as $newKey => $newEntity) {
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
                    unset($friends[$newKey]);
                    $match = true;
                    break;
                }
            }

            if (!$match) {
                $this->friends->remove($key);
            }
        }

        foreach ($friends as $entity) {
            $this->addFriend($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, FriendInterface>
     */
    public function getFriends(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->friends->matching($criteria)->toArray();
        }

        return $this->friends->toArray();
    }

    public function addContact(ContactInterface $contact): CompanyInterface
    {
        $this->contacts->add($contact);

        return $this;
    }

    public function removeContact(ContactInterface $contact): CompanyInterface
    {
        $this->contacts->removeElement($contact);

        return $this;
    }

    /**
     * @param Collection<array-key, ContactInterface> $contacts
     */
    public function replaceContacts(Collection $contacts): CompanyInterface
    {
        foreach ($contacts as $entity) {
            $entity->setCompany($this);
        }

        $toStringCallable = fn(mixed $val): \Stringable|string => $val instanceof \Stringable ? $val : serialize($val);
        foreach ($this->contacts as $key => $entity) {
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
            foreach ($contacts as $newKey => $newEntity) {
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
                    unset($contacts[$newKey]);
                    $match = true;
                    break;
                }
            }

            if (!$match) {
                $this->contacts->remove($key);
            }
        }

        foreach ($contacts as $entity) {
            $this->addContact($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, ContactInterface>
     */
    public function getContacts(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->contacts->matching($criteria)->toArray();
        }

        return $this->contacts->toArray();
    }

    public function addCompanyService(CompanyServiceInterface $companyService): CompanyInterface
    {
        $this->companyServices->add($companyService);

        return $this;
    }

    public function removeCompanyService(CompanyServiceInterface $companyService): CompanyInterface
    {
        $this->companyServices->removeElement($companyService);

        return $this;
    }

    /**
     * @param Collection<array-key, CompanyServiceInterface> $companyServices
     */
    public function replaceCompanyServices(Collection $companyServices): CompanyInterface
    {
        foreach ($companyServices as $entity) {
            $entity->setCompany($this);
        }

        $toStringCallable = fn(mixed $val): \Stringable|string => $val instanceof \Stringable ? $val : serialize($val);
        foreach ($this->companyServices as $key => $entity) {
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
            foreach ($companyServices as $newKey => $newEntity) {
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
                    unset($companyServices[$newKey]);
                    $match = true;
                    break;
                }
            }

            if (!$match) {
                $this->companyServices->remove($key);
            }
        }

        foreach ($companyServices as $entity) {
            $this->addCompanyService($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, CompanyServiceInterface>
     */
    public function getCompanyServices(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->companyServices->matching($criteria)->toArray();
        }

        return $this->companyServices->toArray();
    }

    public function addTerminal(TerminalInterface $terminal): CompanyInterface
    {
        $this->terminals->add($terminal);

        return $this;
    }

    public function removeTerminal(TerminalInterface $terminal): CompanyInterface
    {
        $this->terminals->removeElement($terminal);

        return $this;
    }

    /**
     * @param Collection<array-key, TerminalInterface> $terminals
     */
    public function replaceTerminals(Collection $terminals): CompanyInterface
    {
        foreach ($terminals as $entity) {
            $entity->setCompany($this);
        }

        $toStringCallable = fn(mixed $val): \Stringable|string => $val instanceof \Stringable ? $val : serialize($val);
        foreach ($this->terminals as $key => $entity) {
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
            foreach ($terminals as $newKey => $newEntity) {
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
                    unset($terminals[$newKey]);
                    $match = true;
                    break;
                }
            }

            if (!$match) {
                $this->terminals->remove($key);
            }
        }

        foreach ($terminals as $entity) {
            $this->addTerminal($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, TerminalInterface>
     */
    public function getTerminals(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->terminals->matching($criteria)->toArray();
        }

        return $this->terminals->toArray();
    }

    public function addRatingProfile(RatingProfileInterface $ratingProfile): CompanyInterface
    {
        $this->ratingProfiles->add($ratingProfile);

        return $this;
    }

    public function removeRatingProfile(RatingProfileInterface $ratingProfile): CompanyInterface
    {
        $this->ratingProfiles->removeElement($ratingProfile);

        return $this;
    }

    /**
     * @param Collection<array-key, RatingProfileInterface> $ratingProfiles
     */
    public function replaceRatingProfiles(Collection $ratingProfiles): CompanyInterface
    {
        foreach ($ratingProfiles as $entity) {
            $entity->setCompany($this);
        }

        $toStringCallable = fn(mixed $val): \Stringable|string => $val instanceof \Stringable ? $val : serialize($val);
        foreach ($this->ratingProfiles as $key => $entity) {
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
            foreach ($ratingProfiles as $newKey => $newEntity) {
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
                    unset($ratingProfiles[$newKey]);
                    $match = true;
                    break;
                }
            }

            if (!$match) {
                $this->ratingProfiles->remove($key);
            }
        }

        foreach ($ratingProfiles as $entity) {
            $this->addRatingProfile($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, RatingProfileInterface>
     */
    public function getRatingProfiles(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->ratingProfiles->matching($criteria)->toArray();
        }

        return $this->ratingProfiles->toArray();
    }

    public function addMusicsOnHold(MusicOnHoldInterface $musicsOnHold): CompanyInterface
    {
        $this->musicsOnHold->add($musicsOnHold);

        return $this;
    }

    public function removeMusicsOnHold(MusicOnHoldInterface $musicsOnHold): CompanyInterface
    {
        $this->musicsOnHold->removeElement($musicsOnHold);

        return $this;
    }

    /**
     * @param Collection<array-key, MusicOnHoldInterface> $musicsOnHold
     */
    public function replaceMusicsOnHold(Collection $musicsOnHold): CompanyInterface
    {
        foreach ($musicsOnHold as $entity) {
            $entity->setCompany($this);
        }

        $toStringCallable = fn(mixed $val): \Stringable|string => $val instanceof \Stringable ? $val : serialize($val);
        foreach ($this->musicsOnHold as $key => $entity) {
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
            foreach ($musicsOnHold as $newKey => $newEntity) {
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
                    unset($musicsOnHold[$newKey]);
                    $match = true;
                    break;
                }
            }

            if (!$match) {
                $this->musicsOnHold->remove($key);
            }
        }

        foreach ($musicsOnHold as $entity) {
            $this->addMusicsOnHold($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, MusicOnHoldInterface>
     */
    public function getMusicsOnHold(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->musicsOnHold->matching($criteria)->toArray();
        }

        return $this->musicsOnHold->toArray();
    }

    public function addVoicemail(VoicemailInterface $voicemail): CompanyInterface
    {
        $this->voicemails->add($voicemail);

        return $this;
    }

    public function removeVoicemail(VoicemailInterface $voicemail): CompanyInterface
    {
        $this->voicemails->removeElement($voicemail);

        return $this;
    }

    /**
     * @param Collection<array-key, VoicemailInterface> $voicemails
     */
    public function replaceVoicemails(Collection $voicemails): CompanyInterface
    {
        foreach ($voicemails as $entity) {
            $entity->setCompany($this);
        }

        $toStringCallable = fn(mixed $val): \Stringable|string => $val instanceof \Stringable ? $val : serialize($val);
        foreach ($this->voicemails as $key => $entity) {
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
            foreach ($voicemails as $newKey => $newEntity) {
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
                    unset($voicemails[$newKey]);
                    $match = true;
                    break;
                }
            }

            if (!$match) {
                $this->voicemails->remove($key);
            }
        }

        foreach ($voicemails as $entity) {
            $this->addVoicemail($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, VoicemailInterface>
     */
    public function getVoicemails(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->voicemails->matching($criteria)->toArray();
        }

        return $this->voicemails->toArray();
    }

    public function addRecording(RecordingInterface $recording): CompanyInterface
    {
        $this->recordings->add($recording);

        return $this;
    }

    public function removeRecording(RecordingInterface $recording): CompanyInterface
    {
        $this->recordings->removeElement($recording);

        return $this;
    }

    /**
     * @param Collection<array-key, RecordingInterface> $recordings
     */
    public function replaceRecordings(Collection $recordings): CompanyInterface
    {
        foreach ($recordings as $entity) {
            $entity->setCompany($this);
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
                $this->recordings->remove($key);
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
        if (!is_null($criteria)) {
            return $this->recordings->matching($criteria)->toArray();
        }

        return $this->recordings->toArray();
    }

    public function addRelFeature(FeaturesRelCompanyInterface $relFeature): CompanyInterface
    {
        $this->relFeatures->add($relFeature);

        return $this;
    }

    public function removeRelFeature(FeaturesRelCompanyInterface $relFeature): CompanyInterface
    {
        $this->relFeatures->removeElement($relFeature);

        return $this;
    }

    /**
     * @param Collection<array-key, FeaturesRelCompanyInterface> $relFeatures
     */
    public function replaceRelFeatures(Collection $relFeatures): CompanyInterface
    {
        foreach ($relFeatures as $entity) {
            $entity->setCompany($this);
        }

        $toStringCallable = fn(mixed $val): \Stringable|string => $val instanceof \Stringable ? $val : serialize($val);
        foreach ($this->relFeatures as $key => $entity) {
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
            foreach ($relFeatures as $newKey => $newEntity) {
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
                    unset($relFeatures[$newKey]);
                    $match = true;
                    break;
                }
            }

            if (!$match) {
                $this->relFeatures->remove($key);
            }
        }

        foreach ($relFeatures as $entity) {
            $this->addRelFeature($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, FeaturesRelCompanyInterface>
     */
    public function getRelFeatures(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->relFeatures->matching($criteria)->toArray();
        }

        return $this->relFeatures->toArray();
    }

    public function addRelCountry(CompanyRelGeoIPCountryInterface $relCountry): CompanyInterface
    {
        $this->relCountries->add($relCountry);

        return $this;
    }

    public function removeRelCountry(CompanyRelGeoIPCountryInterface $relCountry): CompanyInterface
    {
        $this->relCountries->removeElement($relCountry);

        return $this;
    }

    /**
     * @param Collection<array-key, CompanyRelGeoIPCountryInterface> $relCountries
     */
    public function replaceRelCountries(Collection $relCountries): CompanyInterface
    {
        foreach ($relCountries as $entity) {
            $entity->setCompany($this);
        }

        $toStringCallable = fn(mixed $val): \Stringable|string => $val instanceof \Stringable ? $val : serialize($val);
        foreach ($this->relCountries as $key => $entity) {
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
            foreach ($relCountries as $newKey => $newEntity) {
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
                    unset($relCountries[$newKey]);
                    $match = true;
                    break;
                }
            }

            if (!$match) {
                $this->relCountries->remove($key);
            }
        }

        foreach ($relCountries as $entity) {
            $this->addRelCountry($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, CompanyRelGeoIPCountryInterface>
     */
    public function getRelCountries(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->relCountries->matching($criteria)->toArray();
        }

        return $this->relCountries->toArray();
    }

    public function addRelCodec(CompanyRelCodecInterface $relCodec): CompanyInterface
    {
        $this->relCodecs->add($relCodec);

        return $this;
    }

    public function removeRelCodec(CompanyRelCodecInterface $relCodec): CompanyInterface
    {
        $this->relCodecs->removeElement($relCodec);

        return $this;
    }

    /**
     * @param Collection<array-key, CompanyRelCodecInterface> $relCodecs
     */
    public function replaceRelCodecs(Collection $relCodecs): CompanyInterface
    {
        foreach ($relCodecs as $entity) {
            $entity->setCompany($this);
        }

        $toStringCallable = fn(mixed $val): \Stringable|string => $val instanceof \Stringable ? $val : serialize($val);
        foreach ($this->relCodecs as $key => $entity) {
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
            foreach ($relCodecs as $newKey => $newEntity) {
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
                    unset($relCodecs[$newKey]);
                    $match = true;
                    break;
                }
            }

            if (!$match) {
                $this->relCodecs->remove($key);
            }
        }

        foreach ($relCodecs as $entity) {
            $this->addRelCodec($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, CompanyRelCodecInterface>
     */
    public function getRelCodecs(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->relCodecs->matching($criteria)->toArray();
        }

        return $this->relCodecs->toArray();
    }

    public function addRelRoutingTag(CompanyRelRoutingTagInterface $relRoutingTag): CompanyInterface
    {
        $this->relRoutingTags->add($relRoutingTag);

        return $this;
    }

    public function removeRelRoutingTag(CompanyRelRoutingTagInterface $relRoutingTag): CompanyInterface
    {
        $this->relRoutingTags->removeElement($relRoutingTag);

        return $this;
    }

    /**
     * @param Collection<array-key, CompanyRelRoutingTagInterface> $relRoutingTags
     */
    public function replaceRelRoutingTags(Collection $relRoutingTags): CompanyInterface
    {
        foreach ($relRoutingTags as $entity) {
            $entity->setCompany($this);
        }

        $toStringCallable = fn(mixed $val): \Stringable|string => $val instanceof \Stringable ? $val : serialize($val);
        foreach ($this->relRoutingTags as $key => $entity) {
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
            foreach ($relRoutingTags as $newKey => $newEntity) {
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
                    unset($relRoutingTags[$newKey]);
                    $match = true;
                    break;
                }
            }

            if (!$match) {
                $this->relRoutingTags->remove($key);
            }
        }

        foreach ($relRoutingTags as $entity) {
            $this->addRelRoutingTag($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, CompanyRelRoutingTagInterface>
     */
    public function getRelRoutingTags(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->relRoutingTags->matching($criteria)->toArray();
        }

        return $this->relRoutingTags->toArray();
    }
}
