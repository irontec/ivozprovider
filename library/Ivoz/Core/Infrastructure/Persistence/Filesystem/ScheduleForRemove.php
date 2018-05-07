<?php

namespace Ivoz\Core\Infrastructure\Persistence\Filesystem;

use Ivoz\Core\Application\Service\StoragePathResolverCollection;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\Service\FileContainerInterface;
use Ivoz\Core\Domain\Service\CommonLifecycleEventHandlerInterface;
use Ivoz\Core\Domain\Service\TempFile;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ScheduleForRemove implements CommonLifecycleEventHandlerInterface
{

    const serviceCollectionPrefix = 'Service\\StoragePathResolverCollection::';
    /**
     * @var ContainerInterface
     */
    protected $serviceContainer;

    public function __construct(ContainerInterface $serviceContainer)
    {
        $this->serviceContainer = $serviceContainer;
    }

    public function handle(EntityInterface $entity, $isNew)
    {
        if (!$entity instanceof FileContainerInterface) {
            return;
        }

        $className = get_class($entity);
        $classSegments = explode('\\', $className);

        /** @var StoragePathResolverCollection $serviceCollection */
        $serviceCollection = $this->serviceContainer->get(
            self::serviceCollectionPrefix . end($classSegments)
        );

        foreach ($entity->getFileObjects() as $fldName) {

            $fldGetter = 'get'. ucFirst($fldName); // .'BaseName';
            $valueObject = $entity->{$fldGetter}();
            $baseName = $valueObject->getBaseName();

            $pathResolver = $serviceCollection->getPathResolver($fldName);
            $pathResolver->setOriginalFileName($baseName);

            $filePath = $pathResolver
                ->getFilePath(
                    $entity
                );

            $entity->addTmpFile(
                $fldName,
                new TempFile(
                    $pathResolver,
                    $filePath
                )
            );
        }
    }
}