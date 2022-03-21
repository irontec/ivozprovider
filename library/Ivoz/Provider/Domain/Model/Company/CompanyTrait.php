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
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($extensions as $entity) {
            /** @var string|int $index */
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCompany($this);
        }

        foreach ($this->extensions as $key => $entity) {
            $identity = $entity->getId();
            if (!$identity) {
                $this->extensions->remove($key);
                continue;
            }

            if (array_key_exists($identity, $updatedEntities)) {
                $this->extensions->set($key, $updatedEntities[$identity]);
                unset($updatedEntities[$identity]);
            } else {
                $this->extensions->remove($key);
            }
        }

        foreach ($updatedEntities as $entity) {
            $this->addExtension($entity);
        }

        return $this;
    }

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
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($ddis as $entity) {
            /** @var string|int $index */
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCompany($this);
        }

        foreach ($this->ddis as $key => $entity) {
            $identity = $entity->getId();
            if (!$identity) {
                $this->ddis->remove($key);
                continue;
            }

            if (array_key_exists($identity, $updatedEntities)) {
                $this->ddis->set($key, $updatedEntities[$identity]);
                unset($updatedEntities[$identity]);
            } else {
                $this->ddis->remove($key);
            }
        }

        foreach ($updatedEntities as $entity) {
            $this->addDdi($entity);
        }

        return $this;
    }

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
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($friends as $entity) {
            /** @var string|int $index */
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCompany($this);
        }

        foreach ($this->friends as $key => $entity) {
            $identity = $entity->getId();
            if (!$identity) {
                $this->friends->remove($key);
                continue;
            }

            if (array_key_exists($identity, $updatedEntities)) {
                $this->friends->set($key, $updatedEntities[$identity]);
                unset($updatedEntities[$identity]);
            } else {
                $this->friends->remove($key);
            }
        }

        foreach ($updatedEntities as $entity) {
            $this->addFriend($entity);
        }

        return $this;
    }

    public function getFriends(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->friends->matching($criteria)->toArray();
        }

        return $this->friends->toArray();
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
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($companyServices as $entity) {
            /** @var string|int $index */
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCompany($this);
        }

        foreach ($this->companyServices as $key => $entity) {
            $identity = $entity->getId();
            if (!$identity) {
                $this->companyServices->remove($key);
                continue;
            }

            if (array_key_exists($identity, $updatedEntities)) {
                $this->companyServices->set($key, $updatedEntities[$identity]);
                unset($updatedEntities[$identity]);
            } else {
                $this->companyServices->remove($key);
            }
        }

        foreach ($updatedEntities as $entity) {
            $this->addCompanyService($entity);
        }

        return $this;
    }

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
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($terminals as $entity) {
            /** @var string|int $index */
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCompany($this);
        }

        foreach ($this->terminals as $key => $entity) {
            $identity = $entity->getId();
            if (!$identity) {
                $this->terminals->remove($key);
                continue;
            }

            if (array_key_exists($identity, $updatedEntities)) {
                $this->terminals->set($key, $updatedEntities[$identity]);
                unset($updatedEntities[$identity]);
            } else {
                $this->terminals->remove($key);
            }
        }

        foreach ($updatedEntities as $entity) {
            $this->addTerminal($entity);
        }

        return $this;
    }

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
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($ratingProfiles as $entity) {
            /** @var string|int $index */
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCompany($this);
        }

        foreach ($this->ratingProfiles as $key => $entity) {
            $identity = $entity->getId();
            if (!$identity) {
                $this->ratingProfiles->remove($key);
                continue;
            }

            if (array_key_exists($identity, $updatedEntities)) {
                $this->ratingProfiles->set($key, $updatedEntities[$identity]);
                unset($updatedEntities[$identity]);
            } else {
                $this->ratingProfiles->remove($key);
            }
        }

        foreach ($updatedEntities as $entity) {
            $this->addRatingProfile($entity);
        }

        return $this;
    }

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
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($musicsOnHold as $entity) {
            /** @var string|int $index */
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCompany($this);
        }

        foreach ($this->musicsOnHold as $key => $entity) {
            $identity = $entity->getId();
            if (!$identity) {
                $this->musicsOnHold->remove($key);
                continue;
            }

            if (array_key_exists($identity, $updatedEntities)) {
                $this->musicsOnHold->set($key, $updatedEntities[$identity]);
                unset($updatedEntities[$identity]);
            } else {
                $this->musicsOnHold->remove($key);
            }
        }

        foreach ($updatedEntities as $entity) {
            $this->addMusicsOnHold($entity);
        }

        return $this;
    }

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
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($voicemails as $entity) {
            /** @var string|int $index */
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCompany($this);
        }

        foreach ($this->voicemails as $key => $entity) {
            $identity = $entity->getId();
            if (!$identity) {
                $this->voicemails->remove($key);
                continue;
            }

            if (array_key_exists($identity, $updatedEntities)) {
                $this->voicemails->set($key, $updatedEntities[$identity]);
                unset($updatedEntities[$identity]);
            } else {
                $this->voicemails->remove($key);
            }
        }

        foreach ($updatedEntities as $entity) {
            $this->addVoicemail($entity);
        }

        return $this;
    }

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
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($recordings as $entity) {
            /** @var string|int $index */
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCompany($this);
        }

        foreach ($this->recordings as $key => $entity) {
            $identity = $entity->getId();
            if (!$identity) {
                $this->recordings->remove($key);
                continue;
            }

            if (array_key_exists($identity, $updatedEntities)) {
                $this->recordings->set($key, $updatedEntities[$identity]);
                unset($updatedEntities[$identity]);
            } else {
                $this->recordings->remove($key);
            }
        }

        foreach ($updatedEntities as $entity) {
            $this->addRecording($entity);
        }

        return $this;
    }

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
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($relFeatures as $entity) {
            /** @var string|int $index */
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCompany($this);
        }

        foreach ($this->relFeatures as $key => $entity) {
            $identity = $entity->getId();
            if (!$identity) {
                $this->relFeatures->remove($key);
                continue;
            }

            if (array_key_exists($identity, $updatedEntities)) {
                $this->relFeatures->set($key, $updatedEntities[$identity]);
                unset($updatedEntities[$identity]);
            } else {
                $this->relFeatures->remove($key);
            }
        }

        foreach ($updatedEntities as $entity) {
            $this->addRelFeature($entity);
        }

        return $this;
    }

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
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($relCountries as $entity) {
            /** @var string|int $index */
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCompany($this);
        }

        foreach ($this->relCountries as $key => $entity) {
            $identity = $entity->getId();
            if (!$identity) {
                $this->relCountries->remove($key);
                continue;
            }

            if (array_key_exists($identity, $updatedEntities)) {
                $this->relCountries->set($key, $updatedEntities[$identity]);
                unset($updatedEntities[$identity]);
            } else {
                $this->relCountries->remove($key);
            }
        }

        foreach ($updatedEntities as $entity) {
            $this->addRelCountry($entity);
        }

        return $this;
    }

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
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($relCodecs as $entity) {
            /** @var string|int $index */
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCompany($this);
        }

        foreach ($this->relCodecs as $key => $entity) {
            $identity = $entity->getId();
            if (!$identity) {
                $this->relCodecs->remove($key);
                continue;
            }

            if (array_key_exists($identity, $updatedEntities)) {
                $this->relCodecs->set($key, $updatedEntities[$identity]);
                unset($updatedEntities[$identity]);
            } else {
                $this->relCodecs->remove($key);
            }
        }

        foreach ($updatedEntities as $entity) {
            $this->addRelCodec($entity);
        }

        return $this;
    }

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
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($relRoutingTags as $entity) {
            /** @var string|int $index */
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCompany($this);
        }

        foreach ($this->relRoutingTags as $key => $entity) {
            $identity = $entity->getId();
            if (!$identity) {
                $this->relRoutingTags->remove($key);
                continue;
            }

            if (array_key_exists($identity, $updatedEntities)) {
                $this->relRoutingTags->set($key, $updatedEntities[$identity]);
                unset($updatedEntities[$identity]);
            } else {
                $this->relRoutingTags->remove($key);
            }
        }

        foreach ($updatedEntities as $entity) {
            $this->addRelRoutingTag($entity);
        }

        return $this;
    }

    public function getRelRoutingTags(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->relRoutingTags->matching($criteria)->toArray();
        }

        return $this->relRoutingTags->toArray();
    }
}
