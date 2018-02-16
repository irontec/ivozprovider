<?php

namespace EntityGeneratorBundle\Command;

use Doctrine\ORM\Tools\EntityGenerator;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use EntityGeneratorBundle\Tools\InterfaceGenerator;

/**
 * Generate entity classes from mapping information
 * @codeCoverageIgnore
 * @author Mikel Madariaga <mikel@irontec.com>
 */
class ClearInterfacesCommand extends GenerateInterfacesCommand
{
    const OUTCOME = 'empty interfaces';

    public function __construct($name = null)
    {
        $this->disconnectedClassMetadata = true;

        return parent::__construct($name);
    }

    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        $this
            ->setName('provider:clear:interfaces')
            ->setAliases(array('clear:provider:interfaces'))
            ->setDescription('Generates empty entity interfaces from your mapping information')
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
        $entityGenerator = new InterfaceGenerator();
        $entityGenerator->setGenerateAnnotations(false);
        $entityGenerator->setGenerateStubMethods(true);
        $entityGenerator->setRegenerateEntityIfExists(true);
        $entityGenerator->setUpdateEntityIfExists(true);
        $entityGenerator->setNumSpaces(4);
        $entityGenerator->setAnnotationPrefix('ORM\\');
        $entityGenerator->createEmptyInterfaces();

        return $entityGenerator;
    }
}
