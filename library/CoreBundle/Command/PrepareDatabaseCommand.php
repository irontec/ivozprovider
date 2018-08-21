<?php

namespace CoreBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\SchemaTool;

/**
 * Generate entity classes from mapping information
 * @codeCoverageIgnore
 * @author Mikel Madariaga <mikel@irontec.com>
 */
class PrepareDatabaseCommand extends ContainerAwareCommand
{
    /**
     * @var ManagerRegistry
     */
    private $doctrine;

    /**
     * @var \Doctrine\Common\Persistence\ObjectManager
     */
    private $manager;

    /**
     * @var SchemaTool
     */
    private $schemaTool;

    /**
     * @var array
     */
    private $classes;

    /**
     * @inheritdoc
     */
    public function __construct($name = null)
    {
        return parent::__construct($name);
    }

    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        $this
            ->setName('core:prepare:database')
            ->setDescription('Fault tolerant database schema generator');
    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->doctrine = $this->getContainer()->get('doctrine');
        $this->manager = $this->doctrine->getManager();
        $this->schemaTool = new SchemaTool($this->manager);
        $this->classes = $this->manager->getMetadataFactory()->getAllMetadata();

        $output->writeln('<info>Preparing database</info>');
        $this->createDatabase($output);
    }

    protected function createDatabase(OutputInterface $output)
    {
        $this->schemaTool->dropSchema($this->classes);
        $createSchemaSql = $this->schemaTool->getCreateSchemaSql($this->classes);
        $conn = $this->manager->getConnection();
        foreach ($createSchemaSql as $sql) {
            try {
                $conn->executeQuery($sql);
            } catch (\Exception $e) {
                $output->writeln("<error>Query error: $sql" . $e->getMessage() . '</error>');
            }
        }
    }
}
