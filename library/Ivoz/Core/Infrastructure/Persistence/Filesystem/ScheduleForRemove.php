<?php

namespace Ivoz\Core\Infrastructure\Persistence\Filesystem;

use Ivoz\Core\Application\Service\StoragePathResolverCollection;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\Service\FileContainerInterface;
use Ivoz\Core\Domain\Service\CommonLifecycleEventHandlerInterface;
use Ivoz\Core\Domain\Service\TempFile;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ScheduleForRemove implements CommonLifecycleEventHandlerInterface
{
    const EVENT_PRE_REMOVE_PRIORITY = self::PRIORITY_NORMAL;

    const serviceCollectionPrefix = 'Service\\StoragePathResolverCollection::';

    /**
     * @var ContainerInterface
     */
    protected $serviceContainer;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    public function __construct(
        ContainerInterface $serviceContainer,
        LoggerInterface $logger
    ) {
        $this->serviceContainer = $serviceContainer;
        $this->logger = $logger;
    }

    /**
     *
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_REMOVE => self::EVENT_PRE_REMOVE_PRIORITY
        ];
    }

    public function handle(EntityInterface $entity)
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
            $fldGetter = 'get'. ucFirst($fldName);
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

            $debugMsg = sprintf(
                'Scheduling %s from %s for removal',
                $fldName,
                get_class($entity)
            );

            $this->logger->debug($debugMsg);
        }
    }
}
