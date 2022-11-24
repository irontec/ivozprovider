<?php

namespace Ivoz\Provider\Application\Service\Brand;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Service\Assembler\CustomDtoAssemblerInterface;
use Ivoz\Core\Application\Service\StoragePathResolverCollection;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\FeaturesRelBrand\FeaturesRelBrand;
use Ivoz\Provider\Domain\Model\ProxyTrunksRelBrand\ProxyTrunksRelBrand;

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

        if (in_array($context, BrandDto::CONTEXTS_WITH_FEATURES, true)) {
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
        }

        if (in_array($context, BrandDto::CONTEXTS_WITH_PROXY_TRUNKS, true)) {
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
        }


        return $dto;
    }
}
