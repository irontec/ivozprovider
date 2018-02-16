<?php

namespace EntityGeneratorBundle\Command;

use Doctrine\Bundle\DoctrineBundle\Command\GenerateEntitiesDoctrineCommand as ParentCommand;
use Doctrine\ORM\Tools\EntityGenerator;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use EntityGeneratorBundle\Tools\AbstractDTOGenerator;

/**
 * Generate entity classes from mapping information
 * @codeCoverageIgnore
 * @author Mikel Madariaga <mikel@irontec.com>
 */
class GenerateAbstractDTOCommand extends ParentCommand
{
    const OUTCOME = 'abstract DTOs';

    use ExecuteGeneratorTrait;

    public function __construct($name = null)
    {
        $this->injectEmbeddedClasses = false;
        $this->mergeEmbeddedClasses = false;
        $this->skipEmbedded = true;
        $this->skipMappedSuperClass = true;

        return parent::__construct($name);
    }

    protected function configure()
    {
        $this
            ->setName('provider:generate:dtos:abstract')
            ->setAliases(array('generate:provider:dtos:abstract'))
            ->setDescription('Generates Abstract DTOs from your mapping information')
            ->addArgument(
                'name',
                InputArgument::REQUIRED,
                'A bundle name, a namespace, or a class name'
            )
            ->addOption(
                'path',
                null,
                InputOption::VALUE_REQUIRED,
                'The path where to generate entities when it cannot be guessed',
                'src'
            );
    }

    /**
     * get a ivozprovider entity generator
     *
     * @return EntityGenerator
     */
    protected function getEntityGenerator()
    {
        $entityGenerator = new AbstractDTOGenerator();
        $entityGenerator->setGenerateAnnotations(false);
        $entityGenerator->setGenerateStubMethods(true);
        $entityGenerator->setRegenerateEntityIfExists(true);
        $entityGenerator->setUpdateEntityIfExists(true);
        $entityGenerator->setNumSpaces(4);
        $entityGenerator->setAnnotationPrefix('ORM\\');

        return $entityGenerator;
    }
}
