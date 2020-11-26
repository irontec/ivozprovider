<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\RetailAccount;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingInterface;

/**
* @codeCoverageIgnore
*/
trait RetailAccountTrait
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var ArrayCollection
     * PsEndpointInterface mappedBy retailAccount
     */
    protected $psEndpoints;

    /**
     * @var ArrayCollection
     * DdiInterface mappedBy retailAccount
     */
    protected $ddis;

    /**
     * @var ArrayCollection
     * CallForwardSettingInterface mappedBy retailAccount
     */
    protected $callForwardSettings;

    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());
        $this->psEndpoints = new ArrayCollection();
        $this->ddis = new ArrayCollection();
        $this->callForwardSettings = new ArrayCollection();
    }

    abstract protected function sanitizeValues();

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param RetailAccountDto $dto
     * @param ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        if (!is_null($dto->getPsEndpoints())) {
            $self->replacePsEndpoints(
                $fkTransformer->transformCollection(
                    $dto->getPsEndpoints()
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

        if (!is_null($dto->getCallForwardSettings())) {
            $self->replaceCallForwardSettings(
                $fkTransformer->transformCollection(
                    $dto->getCallForwardSettings()
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
     * @param RetailAccountDto $dto
     * @param ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        parent::updateFromDto($dto, $fkTransformer);
        if (!is_null($dto->getPsEndpoints())) {
            $this->replacePsEndpoints(
                $fkTransformer->transformCollection(
                    $dto->getPsEndpoints()
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

        if (!is_null($dto->getCallForwardSettings())) {
            $this->replaceCallForwardSettings(
                $fkTransformer->transformCollection(
                    $dto->getCallForwardSettings()
                )
            );
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return RetailAccountDto
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
     * Add psEndpoint
     *
     * @param PsEndpointInterface $psEndpoint
     *
     * @return static
     */
    public function addPsEndpoint(PsEndpointInterface $psEndpoint): RetailAccountInterface
    {
        $this->psEndpoints->add($psEndpoint);

        return $this;
    }

    /**
     * Remove psEndpoint
     *
     * @param PsEndpointInterface $psEndpoint
     *
     * @return static
     */
    public function removePsEndpoint(PsEndpointInterface $psEndpoint): RetailAccountInterface
    {
        $this->psEndpoints->removeElement($psEndpoint);

        return $this;
    }

    /**
     * Replace psEndpoints
     *
     * @param ArrayCollection $psEndpoints of PsEndpointInterface
     *
     * @return static
     */
    public function replacePsEndpoints(ArrayCollection $psEndpoints): RetailAccountInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($psEndpoints as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setRetailAccount($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->psEndpoints as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->psEndpoints->set($key, $updatedEntities[$identity]);
            } else {
                $this->psEndpoints->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addPsEndpoint($entity);
        }

        return $this;
    }

    /**
     * Get psEndpoints
     * @param Criteria | null $criteria
     * @return PsEndpointInterface[]
     */
    public function getPsEndpoints(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->psEndpoints->matching($criteria)->toArray();
        }

        return $this->psEndpoints->toArray();
    }

    /**
     * Add ddi
     *
     * @param DdiInterface $ddi
     *
     * @return static
     */
    public function addDdi(DdiInterface $ddi): RetailAccountInterface
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
    public function removeDdi(DdiInterface $ddi): RetailAccountInterface
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
    public function replaceDdis(ArrayCollection $ddis): RetailAccountInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($ddis as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setRetailAccount($this);
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
     * Add callForwardSetting
     *
     * @param CallForwardSettingInterface $callForwardSetting
     *
     * @return static
     */
    public function addCallForwardSetting(CallForwardSettingInterface $callForwardSetting): RetailAccountInterface
    {
        $this->callForwardSettings->add($callForwardSetting);

        return $this;
    }

    /**
     * Remove callForwardSetting
     *
     * @param CallForwardSettingInterface $callForwardSetting
     *
     * @return static
     */
    public function removeCallForwardSetting(CallForwardSettingInterface $callForwardSetting): RetailAccountInterface
    {
        $this->callForwardSettings->removeElement($callForwardSetting);

        return $this;
    }

    /**
     * Replace callForwardSettings
     *
     * @param ArrayCollection $callForwardSettings of CallForwardSettingInterface
     *
     * @return static
     */
    public function replaceCallForwardSettings(ArrayCollection $callForwardSettings): RetailAccountInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($callForwardSettings as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setRetailAccount($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->callForwardSettings as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->callForwardSettings->set($key, $updatedEntities[$identity]);
            } else {
                $this->callForwardSettings->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addCallForwardSetting($entity);
        }

        return $this;
    }

    /**
     * Get callForwardSettings
     * @param Criteria | null $criteria
     * @return CallForwardSettingInterface[]
     */
    public function getCallForwardSettings(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->callForwardSettings->matching($criteria)->toArray();
        }

        return $this->callForwardSettings->toArray();
    }

}
