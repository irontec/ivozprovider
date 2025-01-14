<?php

namespace Ivoz\Provider\Domain\Assembler\Brand;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\Service\Assembler\CustomDtoAssemblerInterface;
use Ivoz\Core\Domain\Service\StoragePathResolverCollection;
use Ivoz\Provider\Domain\Model\ApplicationServerSetsRelBrand\ApplicationServerSetsRelBrandInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\FeaturesRelBrand\FeaturesRelBrand;
use Ivoz\Provider\Domain\Model\MediaRelaySetsRelBrand\MediaRelaySetsRelBrandInterface;

class BrandDtoAssembler implements CustomDtoAssemblerInterface
{
    public function __construct(
        private StoragePathResolverCollection $storagePathResolver
    ) {
    }

    /**
     * @param BrandInterface $entity
     * @throws \Exception
     */
    public function toDto(EntityInterface $entity, int $depth = 0, string $context = null): DataTransferObjectInterface
    {
        Assertion::isInstanceOf($entity, BrandInterface::class);

        $dto = $entity->toDto($depth);
        $id = $entity->getId();

        if (!$id) {
            return $dto;
        }

        if ($entity->getLogo()->getFileSize()) {
            $pathResolver = $this
                ->storagePathResolver
                ->getPathResolver('Logo');

            $dto->setLogoPath(
                $pathResolver->getFilePath($entity)
            );
        }

        if ($context === DataTransferObjectInterface::CONTEXT_SIMPLE) {
            return $dto;
        }

        $featureIds = array_map(
            function (FeaturesRelBrand $relFeature) {
                return (int) $relFeature
                    ->getFeature()
                    ->getId();
            },
            $entity->getRelFeatures()
        );

        $dto->setFeatures(
            $featureIds
        );

        $proxyTrunksIds = array_map(
            function (EntityInterface $trunksRelBrand) {
                return (int) $trunksRelBrand
                    ->getProxyTrunk()
                    ->getId();
            },
            $entity->getRelProxyTrunks()
        );

        $dto->setProxyTrunks(
            $proxyTrunksIds
        );

        $applicationServerSetIds = array_map(
            function (ApplicationServerSetsRelBrandInterface $applicationServerRelBrand): int {
                return $applicationServerRelBrand
                    ->getApplicationServerSet()
                    ->getId() ?? -1;
            },
            $entity->getRelApplicationServerSets()
        );

        $dto->setApplicationServerSets(
            $applicationServerSetIds
        );

        $mediaRelaySetIds = array_map(
            function (MediaRelaySetsRelBrandInterface $mediaRelaySetRelBrand): int {
                return $mediaRelaySetRelBrand
                    ->getMediaRelaySet()
                    ->getId() ?? -1;
            },
            $entity->getRelMediaRelaySets()
        );

        $dto->setMediaRelaySets(
            $mediaRelaySetIds
        );

        return $dto;
    }
}
