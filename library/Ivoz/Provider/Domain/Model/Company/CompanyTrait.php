<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\Company;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\Friend\FriendInterface;
use Ivoz\Provider\Domain\Model\CompanyService\CompanyServiceInterface;
use Ivoz\Provider\Domain\Model\Terminal\TerminalInterface;
use Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface;
use Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHoldInterface;
use Ivoz\Provider\Domain\Model\Recording\RecordingInterface;
use Ivoz\Provider\Domain\Model\FeaturesRelCompany\FeaturesRelCompanyInterface;
use Ivoz\Provider\Domain\Model\CompanyRelCodec\CompanyRelCodecInterface;
use Ivoz\Provider\Domain\Model\CompanyRelRoutingTag\CompanyRelRoutingTagInterface;

/**
* @codeCoverageIgnore
*/
trait CompanyTrait
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var ArrayCollection
     * ExtensionInterface mappedBy company
     */
    protected $extensions;

    /**
     * @var ArrayCollection
     * DdiInterface mappedBy company
     */
    protected $ddis;

    /**
     * @var ArrayCollection
     * FriendInterface mappedBy company
     */
    protected $friends;

    /**
     * @var ArrayCollection
     * CompanyServiceInterface mappedBy company
     */
    protected $companyServices;

    /**
     * @var ArrayCollection
     * TerminalInterface mappedBy company
     */
    protected $terminals;

    /**
     * @var ArrayCollection
     * RatingProfileInterface mappedBy company
     */
    protected $ratingProfiles;

    /**
     * @var ArrayCollection
     * MusicOnHoldInterface mappedBy company
     */
    protected $musicsOnHold;

    /**
     * @var ArrayCollection
     * RecordingInterface mappedBy company
     */
    protected $recordings;

    /**
     * @var ArrayCollection
     * FeaturesRelCompanyInterface mappedBy company
     * orphanRemoval
     */
    protected $relFeatures;

    /**
     * @var ArrayCollection
     * CompanyRelCodecInterface mappedBy company
     * orphanRemoval
     */
    protected $relCodecs;

    /**
     * @var ArrayCollection
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
        $this->recordings = new ArrayCollection();
        $this->relFeatures = new ArrayCollection();
        $this->relCodecs = new ArrayCollection();
        $this->relRoutingTags = new ArrayCollection();
    }

    abstract protected function sanitizeValues();

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param CompanyDto $dto
     * @param ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        if (!is_null($dto->getExtensions())) {
            $self->replaceExtensions(
                $fkTransformer->transformCollection(
                    $dto->getExtensions()
                )
            );
        }

        if (!is_null($dto->getDdis())) {
            $self->replaceDdis(
                $fkTransformer->transformCollection(
                    $dto->getDdis()
                )
            );
        }

        if (!is_null($dto->getFriends())) {
            $self->replaceFriends(
                $fkTransformer->transformCollection(
                    $dto->getFriends()
                )
            );
        }

        if (!is_null($dto->getCompanyServices())) {
            $self->replaceCompanyServices(
                $fkTransformer->transformCollection(
                    $dto->getCompanyServices()
                )
            );
        }

        if (!is_null($dto->getTerminals())) {
            $self->replaceTerminals(
                $fkTransformer->transformCollection(
                    $dto->getTerminals()
                )
            );
        }

        if (!is_null($dto->getRatingProfiles())) {
            $self->replaceRatingProfiles(
                $fkTransformer->transformCollection(
                    $dto->getRatingProfiles()
                )
            );
        }

        if (!is_null($dto->getMusicsOnHold())) {
            $self->replaceMusicsOnHold(
                $fkTransformer->transformCollection(
                    $dto->getMusicsOnHold()
                )
            );
        }

        if (!is_null($dto->getRecordings())) {
            $self->replaceRecordings(
                $fkTransformer->transformCollection(
                    $dto->getRecordings()
                )
            );
        }

        if (!is_null($dto->getRelFeatures())) {
            $self->replaceRelFeatures(
                $fkTransformer->transformCollection(
                    $dto->getRelFeatures()
                )
            );
        }

        if (!is_null($dto->getRelCodecs())) {
            $self->replaceRelCodecs(
                $fkTransformer->transformCollection(
                    $dto->getRelCodecs()
                )
            );
        }

        if (!is_null($dto->getRelRoutingTags())) {
            $self->replaceRelRoutingTags(
                $fkTransformer->transformCollection(
                    $dto->getRelRoutingTags()
                )
            );
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
     * @param ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        parent::updateFromDto($dto, $fkTransformer);
        if (!is_null($dto->getExtensions())) {
            $this->replaceExtensions(
                $fkTransformer->transformCollection(
                    $dto->getExtensions()
                )
            );
        }

        if (!is_null($dto->getDdis())) {
            $this->replaceDdis(
                $fkTransformer->transformCollection(
                    $dto->getDdis()
                )
            );
        }

        if (!is_null($dto->getFriends())) {
            $this->replaceFriends(
                $fkTransformer->transformCollection(
                    $dto->getFriends()
                )
            );
        }

        if (!is_null($dto->getCompanyServices())) {
            $this->replaceCompanyServices(
                $fkTransformer->transformCollection(
                    $dto->getCompanyServices()
                )
            );
        }

        if (!is_null($dto->getTerminals())) {
            $this->replaceTerminals(
                $fkTransformer->transformCollection(
                    $dto->getTerminals()
                )
            );
        }

        if (!is_null($dto->getRatingProfiles())) {
            $this->replaceRatingProfiles(
                $fkTransformer->transformCollection(
                    $dto->getRatingProfiles()
                )
            );
        }

        if (!is_null($dto->getMusicsOnHold())) {
            $this->replaceMusicsOnHold(
                $fkTransformer->transformCollection(
                    $dto->getMusicsOnHold()
                )
            );
        }

        if (!is_null($dto->getRecordings())) {
            $this->replaceRecordings(
                $fkTransformer->transformCollection(
                    $dto->getRecordings()
                )
            );
        }

        if (!is_null($dto->getRelFeatures())) {
            $this->replaceRelFeatures(
                $fkTransformer->transformCollection(
                    $dto->getRelFeatures()
                )
            );
        }

        if (!is_null($dto->getRelCodecs())) {
            $this->replaceRelCodecs(
                $fkTransformer->transformCollection(
                    $dto->getRelCodecs()
                )
            );
        }

        if (!is_null($dto->getRelRoutingTags())) {
            $this->replaceRelRoutingTags(
                $fkTransformer->transformCollection(
                    $dto->getRelRoutingTags()
                )
            );
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return CompanyDto
     */
    public function toDto($depth = 0)
    {
        $dto = parent::toDto($depth);
        return $dto
            ->setId($this->getId());
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return parent::__toArray() + [
            'id' => self::getId()
        ];
    }

    /**
     * Add extension
     *
     * @param ExtensionInterface $extension
     *
     * @return static
     */
    public function addExtension(ExtensionInterface $extension): CompanyInterface
    {
        $this->extensions->add($extension);

        return $this;
    }

    /**
     * Remove extension
     *
     * @param ExtensionInterface $extension
     *
     * @return static
     */
    public function removeExtension(ExtensionInterface $extension): CompanyInterface
    {
        $this->extensions->removeElement($extension);

        return $this;
    }

    /**
     * Replace extensions
     *
     * @param ArrayCollection $extensions of ExtensionInterface
     *
     * @return static
     */
    public function replaceExtensions(ArrayCollection $extensions): CompanyInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($extensions as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCompany($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->extensions as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->extensions->set($key, $updatedEntities[$identity]);
            } else {
                $this->extensions->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addExtension($entity);
        }

        return $this;
    }

    /**
     * Get extensions
     * @param Criteria | null $criteria
     * @return ExtensionInterface[]
     */
    public function getExtensions(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->extensions->matching($criteria)->toArray();
        }

        return $this->extensions->toArray();
    }

    /**
     * Add ddi
     *
     * @param DdiInterface $ddi
     *
     * @return static
     */
    public function addDdi(DdiInterface $ddi): CompanyInterface
    {
        $this->ddis->add($ddi);

        return $this;
    }

    /**
     * Remove ddi
     *
     * @param DdiInterface $ddi
     *
     * @return static
     */
    public function removeDdi(DdiInterface $ddi): CompanyInterface
    {
        $this->ddis->removeElement($ddi);

        return $this;
    }

    /**
     * Replace ddis
     *
     * @param ArrayCollection $ddis of DdiInterface
     *
     * @return static
     */
    public function replaceDdis(ArrayCollection $ddis): CompanyInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($ddis as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCompany($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->ddis as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->ddis->set($key, $updatedEntities[$identity]);
            } else {
                $this->ddis->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addDdi($entity);
        }

        return $this;
    }

    /**
     * Get ddis
     * @param Criteria | null $criteria
     * @return DdiInterface[]
     */
    public function getDdis(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->ddis->matching($criteria)->toArray();
        }

        return $this->ddis->toArray();
    }

    /**
     * Add friend
     *
     * @param FriendInterface $friend
     *
     * @return static
     */
    public function addFriend(FriendInterface $friend): CompanyInterface
    {
        $this->friends->add($friend);

        return $this;
    }

    /**
     * Remove friend
     *
     * @param FriendInterface $friend
     *
     * @return static
     */
    public function removeFriend(FriendInterface $friend): CompanyInterface
    {
        $this->friends->removeElement($friend);

        return $this;
    }

    /**
     * Replace friends
     *
     * @param ArrayCollection $friends of FriendInterface
     *
     * @return static
     */
    public function replaceFriends(ArrayCollection $friends): CompanyInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($friends as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCompany($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->friends as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->friends->set($key, $updatedEntities[$identity]);
            } else {
                $this->friends->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addFriend($entity);
        }

        return $this;
    }

    /**
     * Get friends
     * @param Criteria | null $criteria
     * @return FriendInterface[]
     */
    public function getFriends(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->friends->matching($criteria)->toArray();
        }

        return $this->friends->toArray();
    }

    /**
     * Add companyService
     *
     * @param CompanyServiceInterface $companyService
     *
     * @return static
     */
    public function addCompanyService(CompanyServiceInterface $companyService): CompanyInterface
    {
        $this->companyServices->add($companyService);

        return $this;
    }

    /**
     * Remove companyService
     *
     * @param CompanyServiceInterface $companyService
     *
     * @return static
     */
    public function removeCompanyService(CompanyServiceInterface $companyService): CompanyInterface
    {
        $this->companyServices->removeElement($companyService);

        return $this;
    }

    /**
     * Replace companyServices
     *
     * @param ArrayCollection $companyServices of CompanyServiceInterface
     *
     * @return static
     */
    public function replaceCompanyServices(ArrayCollection $companyServices): CompanyInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($companyServices as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCompany($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->companyServices as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->companyServices->set($key, $updatedEntities[$identity]);
            } else {
                $this->companyServices->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addCompanyService($entity);
        }

        return $this;
    }

    /**
     * Get companyServices
     * @param Criteria | null $criteria
     * @return CompanyServiceInterface[]
     */
    public function getCompanyServices(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->companyServices->matching($criteria)->toArray();
        }

        return $this->companyServices->toArray();
    }

    /**
     * Add terminal
     *
     * @param TerminalInterface $terminal
     *
     * @return static
     */
    public function addTerminal(TerminalInterface $terminal): CompanyInterface
    {
        $this->terminals->add($terminal);

        return $this;
    }

    /**
     * Remove terminal
     *
     * @param TerminalInterface $terminal
     *
     * @return static
     */
    public function removeTerminal(TerminalInterface $terminal): CompanyInterface
    {
        $this->terminals->removeElement($terminal);

        return $this;
    }

    /**
     * Replace terminals
     *
     * @param ArrayCollection $terminals of TerminalInterface
     *
     * @return static
     */
    public function replaceTerminals(ArrayCollection $terminals): CompanyInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($terminals as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCompany($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->terminals as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->terminals->set($key, $updatedEntities[$identity]);
            } else {
                $this->terminals->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addTerminal($entity);
        }

        return $this;
    }

    /**
     * Get terminals
     * @param Criteria | null $criteria
     * @return TerminalInterface[]
     */
    public function getTerminals(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->terminals->matching($criteria)->toArray();
        }

        return $this->terminals->toArray();
    }

    /**
     * Add ratingProfile
     *
     * @param RatingProfileInterface $ratingProfile
     *
     * @return static
     */
    public function addRatingProfile(RatingProfileInterface $ratingProfile): CompanyInterface
    {
        $this->ratingProfiles->add($ratingProfile);

        return $this;
    }

    /**
     * Remove ratingProfile
     *
     * @param RatingProfileInterface $ratingProfile
     *
     * @return static
     */
    public function removeRatingProfile(RatingProfileInterface $ratingProfile): CompanyInterface
    {
        $this->ratingProfiles->removeElement($ratingProfile);

        return $this;
    }

    /**
     * Replace ratingProfiles
     *
     * @param ArrayCollection $ratingProfiles of RatingProfileInterface
     *
     * @return static
     */
    public function replaceRatingProfiles(ArrayCollection $ratingProfiles): CompanyInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($ratingProfiles as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCompany($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->ratingProfiles as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->ratingProfiles->set($key, $updatedEntities[$identity]);
            } else {
                $this->ratingProfiles->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addRatingProfile($entity);
        }

        return $this;
    }

    /**
     * Get ratingProfiles
     * @param Criteria | null $criteria
     * @return RatingProfileInterface[]
     */
    public function getRatingProfiles(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->ratingProfiles->matching($criteria)->toArray();
        }

        return $this->ratingProfiles->toArray();
    }

    /**
     * Add musicsOnHold
     *
     * @param MusicOnHoldInterface $musicsOnHold
     *
     * @return static
     */
    public function addMusicsOnHold(MusicOnHoldInterface $musicsOnHold): CompanyInterface
    {
        $this->musicsOnHold->add($musicsOnHold);

        return $this;
    }

    /**
     * Remove musicsOnHold
     *
     * @param MusicOnHoldInterface $musicsOnHold
     *
     * @return static
     */
    public function removeMusicsOnHold(MusicOnHoldInterface $musicsOnHold): CompanyInterface
    {
        $this->musicsOnHold->removeElement($musicsOnHold);

        return $this;
    }

    /**
     * Replace musicsOnHold
     *
     * @param ArrayCollection $musicsOnHold of MusicOnHoldInterface
     *
     * @return static
     */
    public function replaceMusicsOnHold(ArrayCollection $musicsOnHold): CompanyInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($musicsOnHold as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCompany($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->musicsOnHold as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->musicsOnHold->set($key, $updatedEntities[$identity]);
            } else {
                $this->musicsOnHold->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addMusicsOnHold($entity);
        }

        return $this;
    }

    /**
     * Get musicsOnHold
     * @param Criteria | null $criteria
     * @return MusicOnHoldInterface[]
     */
    public function getMusicsOnHold(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->musicsOnHold->matching($criteria)->toArray();
        }

        return $this->musicsOnHold->toArray();
    }

    /**
     * Add recording
     *
     * @param RecordingInterface $recording
     *
     * @return static
     */
    public function addRecording(RecordingInterface $recording): CompanyInterface
    {
        $this->recordings->add($recording);

        return $this;
    }

    /**
     * Remove recording
     *
     * @param RecordingInterface $recording
     *
     * @return static
     */
    public function removeRecording(RecordingInterface $recording): CompanyInterface
    {
        $this->recordings->removeElement($recording);

        return $this;
    }

    /**
     * Replace recordings
     *
     * @param ArrayCollection $recordings of RecordingInterface
     *
     * @return static
     */
    public function replaceRecordings(ArrayCollection $recordings): CompanyInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($recordings as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCompany($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->recordings as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->recordings->set($key, $updatedEntities[$identity]);
            } else {
                $this->recordings->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addRecording($entity);
        }

        return $this;
    }

    /**
     * Get recordings
     * @param Criteria | null $criteria
     * @return RecordingInterface[]
     */
    public function getRecordings(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->recordings->matching($criteria)->toArray();
        }

        return $this->recordings->toArray();
    }

    /**
     * Add relFeature
     *
     * @param FeaturesRelCompanyInterface $relFeature
     *
     * @return static
     */
    public function addRelFeature(FeaturesRelCompanyInterface $relFeature): CompanyInterface
    {
        $this->relFeatures->add($relFeature);

        return $this;
    }

    /**
     * Remove relFeature
     *
     * @param FeaturesRelCompanyInterface $relFeature
     *
     * @return static
     */
    public function removeRelFeature(FeaturesRelCompanyInterface $relFeature): CompanyInterface
    {
        $this->relFeatures->removeElement($relFeature);

        return $this;
    }

    /**
     * Replace relFeatures
     *
     * @param ArrayCollection $relFeatures of FeaturesRelCompanyInterface
     *
     * @return static
     */
    public function replaceRelFeatures(ArrayCollection $relFeatures): CompanyInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($relFeatures as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCompany($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->relFeatures as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->relFeatures->set($key, $updatedEntities[$identity]);
            } else {
                $this->relFeatures->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addRelFeature($entity);
        }

        return $this;
    }

    /**
     * Get relFeatures
     * @param Criteria | null $criteria
     * @return FeaturesRelCompanyInterface[]
     */
    public function getRelFeatures(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->relFeatures->matching($criteria)->toArray();
        }

        return $this->relFeatures->toArray();
    }

    /**
     * Add relCodec
     *
     * @param CompanyRelCodecInterface $relCodec
     *
     * @return static
     */
    public function addRelCodec(CompanyRelCodecInterface $relCodec): CompanyInterface
    {
        $this->relCodecs->add($relCodec);

        return $this;
    }

    /**
     * Remove relCodec
     *
     * @param CompanyRelCodecInterface $relCodec
     *
     * @return static
     */
    public function removeRelCodec(CompanyRelCodecInterface $relCodec): CompanyInterface
    {
        $this->relCodecs->removeElement($relCodec);

        return $this;
    }

    /**
     * Replace relCodecs
     *
     * @param ArrayCollection $relCodecs of CompanyRelCodecInterface
     *
     * @return static
     */
    public function replaceRelCodecs(ArrayCollection $relCodecs): CompanyInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($relCodecs as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCompany($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->relCodecs as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->relCodecs->set($key, $updatedEntities[$identity]);
            } else {
                $this->relCodecs->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addRelCodec($entity);
        }

        return $this;
    }

    /**
     * Get relCodecs
     * @param Criteria | null $criteria
     * @return CompanyRelCodecInterface[]
     */
    public function getRelCodecs(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->relCodecs->matching($criteria)->toArray();
        }

        return $this->relCodecs->toArray();
    }

    /**
     * Add relRoutingTag
     *
     * @param CompanyRelRoutingTagInterface $relRoutingTag
     *
     * @return static
     */
    public function addRelRoutingTag(CompanyRelRoutingTagInterface $relRoutingTag): CompanyInterface
    {
        $this->relRoutingTags->add($relRoutingTag);

        return $this;
    }

    /**
     * Remove relRoutingTag
     *
     * @param CompanyRelRoutingTagInterface $relRoutingTag
     *
     * @return static
     */
    public function removeRelRoutingTag(CompanyRelRoutingTagInterface $relRoutingTag): CompanyInterface
    {
        $this->relRoutingTags->removeElement($relRoutingTag);

        return $this;
    }

    /**
     * Replace relRoutingTags
     *
     * @param ArrayCollection $relRoutingTags of CompanyRelRoutingTagInterface
     *
     * @return static
     */
    public function replaceRelRoutingTags(ArrayCollection $relRoutingTags): CompanyInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($relRoutingTags as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCompany($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->relRoutingTags as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->relRoutingTags->set($key, $updatedEntities[$identity]);
            } else {
                $this->relRoutingTags->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addRelRoutingTag($entity);
        }

        return $this;
    }

    /**
     * Get relRoutingTags
     * @param Criteria | null $criteria
     * @return CompanyRelRoutingTagInterface[]
     */
    public function getRelRoutingTags(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->relRoutingTags->matching($criteria)->toArray();
        }

        return $this->relRoutingTags->toArray();
    }

}
