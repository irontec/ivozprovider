<?php

namespace EntityGeneratorBundle\Command;

use Symfony\Component\Console\Input\InputInterface;
use Doctrine\ORM\Tools\EntityRepositoryGenerator;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @codeCoverageIgnore
 */
trait ExecuteGeneratorTrait
{
    protected $skipEmbedded;
    protected $skipMappedSuperClass;
    protected $skipEntities;
    protected $mergeEmbeddedClasses;
    protected $injectEmbeddedClasses;
    protected $disconnectedClassMetadata = false;

    /**
     * @var MetadataFactory;
     */
    protected $manager;
    protected $input;

    /**
     * {@inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->manager = $manager = new MetadataFactory($this->getContainer()->get('doctrine'));
        $this->input = $input;

        try {
            $bundle = $this->getApplication()->getKernel()->getBundle($input->getArgument('name'));

            $output->writeln(sprintf('Generating entities for bundle "<info>%s</info>"', $bundle->getName()));
            $metadata = $manager->getBundleMetadata($bundle);
        } catch (\InvalidArgumentException $e) {
            $name = strtr($input->getArgument('name'), '/', '\\');

            if (false !== $pos = strpos($name, ':')) {
                $name = $this->getContainer()->get('doctrine')->getAliasNamespace(substr($name, 0, $pos)).'\\'.substr($name, $pos + 1);
            }

            if (class_exists($name)) {
                $output->writeln(sprintf('Generating entity "<info>%s</info>"', $name));
                $metadata = $manager->getClassMetadata(
                    $name,
                    $input->getOption('path'),
                    $this->disconnectedClassMetadata
                );
            } else {
                $output->writeln(sprintf('Generating '. self::OUTCOME .' for namespace "<info>%s</info>"', $name));
                $metadata = $manager->getNamespaceMetadata(
                    $name,
                    $input->getOption('path'),
                    $this->disconnectedClassMetadata
                );
            }
        }

        $generator = $this->getEntityGenerator();

        $backupExisting = false;
        $generator->setBackupExisting($backupExisting);
        $repoGenerator = new EntityRepositoryGenerator();

        /**
         * @var $m \Doctrine\ORM\Mapping\ClassMetadata
         */
        foreach ($metadata->getMetadata() as $m) {
            $skip = $this->skipEmbedded && $m->isEmbeddedClass;
            $skip = $skip || ($this->skipMappedSuperClass && $m->isMappedSuperclass);
            $skip = $skip || ($this->skipEntities && !$m->isMappedSuperclass && !$m->isEmbeddedClass);

            if ($skip) {
                continue;
            }

            if ($this->mergeEmbeddedClasses) {
                $m = $this->meldEmbedded($metadata, $m);
            } elseif ($this->injectEmbeddedClasses) {
                $m = $this->injectEmbeddedClasses($metadata, $m);
            }

            if ($backupExisting) {
                $basename = substr($m->name, strrpos($m->name, '\\') + 1);
                $output->writeln(sprintf('  > backing up <comment>%s.php</comment> to <comment>%s.php~</comment>', $basename, $basename));
            }
            // Getting the metadata for the entity class once more to get the correct path if the namespace has multiple occurrences
            try {
                $entityMetadata = $manager->getClassMetadata(
                    $m->getName(),
                    $input->getOption('path'),
                    $this->disconnectedClassMetadata
                );
            } catch (\RuntimeException $e) {
                // fall back to the bundle metadata when no entity class could be found
                $entityMetadata = $metadata;
            }

            $generator->generate(array($m), $entityMetadata->getPath());
            $output->writeln(sprintf('  > generated <comment>%s</comment>', $m->name));

            if ($m->customRepositoryClassName && false !== strpos($m->customRepositoryClassName, $metadata->getNamespace())) {
                $repoGenerator->writeEntityRepositoryClass($m->customRepositoryClassName, $metadata->getPath());
            }
        }
    }

    private function injectEmbeddedClasses($metadata, $entity)
    {
        foreach ($entity->fieldMappings as $key => $field) {
            if (strpos($field['type'], '\\') !== false) {
                $entity->fieldMappings[$key]['embeddedClass'] = $this->retrieveEntity($metadata, $field['type']);
            }
        }

        if (isset($entity->embeddedClasses)) {
            foreach ($entity->embeddedClasses as $property => $embeddableClass) {
                $embeddableMetadata = $this->manager->getClassMetadata(
                    $embeddableClass['class'],
                    $this->input->getOption('path'),
                    $this->disconnectedClassMetadata
                );
                $classEmbeddableMetadata = $embeddableMetadata->getMetadata();
                $entity->inlineEmbeddable($property, current($classEmbeddableMetadata));
            }
        }

        return $entity;
    }

    private function meldEmbedded($metadata, $entity)
    {
        foreach ($entity->fieldMappings as $key => $field) {
            if (strpos($field['type'], '\\') !== false) {
                unset($entity->fieldMappings[$key]);
                unset($entity->columnNames[$key]);
                unset($entity->reflFields[$key]);

                $embeddedClass = $this->retrieveEntity($metadata, $field['type']);
                $entity->fieldMappings = $entity->fieldMappings + $embeddedClass->fieldMappings;
                $entity->columnNames = $entity->columnNames + $embeddedClass->columnNames;
                $entity->reflFields = $entity->reflFields + $embeddedClass->reflFields;
            }
        }

        return $entity;
    }

    private function retrieveEntity($metadata, $needle)
    {
        if ($needle[0] !== '\\') {
            $needle = '\\' . $needle;
        }

        foreach ($metadata->getMetadata() as $key => $entity) {
            $name = $entity->name;
            if ($name[0] !== '\\') {
                $name = '\\' . $name;
            }

            if ($name === $needle) {
                return $entity;
            }
        }

        throw new \Exception('Embedded class ' . $needle  . ' not found');
    }
}
