<?php

namespace EntityGeneratorBundle\Command;

use Doctrine\Bundle\DoctrineBundle\Mapping\DisconnectedMetadataFactory;
use Doctrine\ORM\Mapping\ClassMetadataFactory;
use Doctrine\ORM\Tools\DisconnectedClassMetadataFactory;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Mapping\ClassMetadataCollection;
use Doctrine\ORM\Mapping\MappingException;

/**
 * {@inheritDoc}
 * @codeCoverageIgnore
 */
class MetadataFactory extends DisconnectedMetadataFactory
{
    private $registry;

    /**
     * {@inheritDoc}
     */
    public function __construct(ManagerRegistry $registry)
    {
        $this->registry = $registry;
    }

    /**
     * {@inheritDoc}
     */
    public function getClassMetadata($class, $path = null, $disconnectedClassMetadata = false)
    {
        $metadata = $this->getMetadataForClass($class, $disconnectedClassMetadata);
        if (!$metadata->getMetadata()) {
            throw MappingException::classIsNotAValidEntityOrMappedSuperClass($class);
        }

        $this->findNamespaceAndPathForMetadata($metadata, $path);

        return $metadata;
    }

    /**
     * {@inheritDoc}
     */
    private function getMetadataForClass($entity, $disconnectedClassMetadata)
    {
        foreach ($this->registry->getManagers() as $em) {
            $cmf = new ClassMetadataFactory();
            $cmf->setEntityManager($em);

            if (!$cmf->isTransient($entity)) {
                if ($disconnectedClassMetadata) {
                    $disconnectedCmf = new DisconnectedClassMetadataFactory();
                    $disconnectedCmf->setEntityManager($em);
                    $metadata = array($disconnectedCmf->getMetadataFor($entity));
                } else {
                    $metadata = array($cmf->getMetadataFor($entity));
                }

                return new ClassMetadataCollection($metadata);
            }
        }

        return new ClassMetadataCollection(array());
    }

    /**
     * {@inheritDoc}
     */
    public function getNamespaceMetadata($namespace, $path = null, $disconnectedClassMetadata = false)
    {
        $metadata = $this->getMetadataForNamespace($namespace, $disconnectedClassMetadata);
        if (!$metadata->getMetadata()) {
            throw new \RuntimeException(sprintf('Namespace "%s" does not contain any mapped entities.', $namespace));
        }

        $this->findNamespaceAndPathForMetadata(
            $metadata,
            $path
        );

        return $metadata;
    }

    /**
     * {@inheritDoc}
     */
    private function getMetadataForNamespace($namespace, $disconnectedClassMetadata)
    {
        $metadata = array();
        foreach ($this->getAllMetadata($disconnectedClassMetadata) as $m) {
            if (strpos($m->name, $namespace) === 0) {
                $metadata[] = $m;
            }
        }

        return new ClassMetadataCollection($metadata);
    }

    /**
     * {@inheritDoc}
     */
    private function getAllMetadata($disconnectedClassMetadata)
    {
        $metadata = array();

        if ($disconnectedClassMetadata) {
            $disconnectedCmf = new DisconnectedClassMetadataFactory();
            foreach ($this->registry->getManagers() as $em) {
                $disconnectedCmf->setEntityManager($em);
                foreach ($disconnectedCmf->getAllMetadata() as $m) {
                    $metadata[] = $m;
                }
            }
        } else {
            $cmf = new ClassMetadataFactory();
            foreach ($this->registry->getManagers() as $em) {
                $cmf->setEntityManager($em);
                foreach ($cmf->getAllMetadata() as $m) {
                    $metadata[] = $m;
                }
            }
        }

        return $metadata;
    }
}
