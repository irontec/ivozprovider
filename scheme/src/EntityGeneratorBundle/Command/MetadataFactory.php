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
    public function getClassMetadata($class, $path = null)
    {
        $metadata = $this->getMetadataForClass($class);
        if (!$metadata->getMetadata()) {
            throw MappingException::classIsNotAValidEntityOrMappedSuperClass($class);
        }

        $this->findNamespaceAndPathForMetadata($metadata, $path);

        return $metadata;
    }

    /**
     * {@inheritDoc}
     */
    private function getMetadataForClass($entity)
    {
        foreach ($this->registry->getManagers() as $em) {
            $cmf = new ClassMetadataFactory();
            $cmf->setEntityManager($em);

            if (!$cmf->isTransient($entity)) {

//                try {

                    $metadata = array($cmf->getMetadataFor($entity));

//                } catch (\Exception $e) {
//
//                    $disconnectedCmf = new DisconnectedClassMetadataFactory();
//                    $disconnectedCmf->setEntityManager($em);
//                    $metadata = array($disconnectedCmf->getMetadataFor($entity));
//                }

                return new ClassMetadataCollection($metadata);
            }
        }

        return new ClassMetadataCollection(array());
    }

    /**
     * {@inheritDoc}
     */
    public function getNamespaceMetadata($namespace, $path = null)
    {
        $metadata = $this->getMetadataForNamespace($namespace);
        if (!$metadata->getMetadata()) {
            throw new \RuntimeException(sprintf('Namespace "%s" does not contain any mapped entities.', $namespace));
        }

        $this->findNamespaceAndPathForMetadata($metadata, $path);

        return $metadata;
    }

    /**
     * {@inheritDoc}
     */
    private function getMetadataForNamespace($namespace)
    {
        $metadata = array();
        foreach ($this->getAllMetadata() as $m) {
            if (strpos($m->name, $namespace) === 0) {
                $metadata[] = $m;
            }
        }

        return new ClassMetadataCollection($metadata);
    }

    /**
     * {@inheritDoc}
     */
    private function getAllMetadata()
    {
        $metadata = array();

        try {

            $cmf = new ClassMetadataFactory();
            foreach ($this->registry->getManagers() as $em) {
                $cmf->setEntityManager($em);
                foreach ($cmf->getAllMetadata() as $m) {
                    $metadata[] = $m;
                }
            }
        } catch (\Exception $e) {

            $disconnectedCmf = new DisconnectedClassMetadataFactory();
            foreach ($this->registry->getManagers() as $em) {
                $disconnectedCmf->setEntityManager($em);
                foreach ($disconnectedCmf->getAllMetadata() as $m) {
                    $metadata[] = $m;
                }
            }
        }

        return $metadata;
    }
}
