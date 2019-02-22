<?php

namespace Ivoz\Api\Behat\Context;

use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use SebastianBergmann\CodeCoverage\CodeCoverage;
use SebastianBergmann\CodeCoverage\Filter;
use SebastianBergmann\CodeCoverage\Report\Html\Facade;
use SebastianBergmann\CodeCoverage\Report\PHP;

class CoverageContext implements Context
{
    /**
     * @var CodeCoverage
     */
    private static $coverage;

    /**
     * @BeforeSuite
     */
    public static function setup()
    {
        $filter = new Filter();
        $filter
            ->addDirectoryToWhitelist('/opt/irontec/ivozprovider/library/Ivoz');
        $filter
            ->addDirectoryToWhitelist(__DIR__ . '/../../src');
        self::$coverage = new CodeCoverage(null, $filter);
        self::$coverage->setProcessUncoveredFilesFromWhitelist(true);
    }

    /**
     * @AfterSuite
     */
    public static function tearDown()
    {
        $feature = getenv('FEATURE') ?: 'behat';
        (new Facade())->process(self::$coverage, __DIR__ . "/../coverage/");
        (new PHP())->process(self::$coverage, __DIR__ . "/../coverage/coverage.php");
    }

    /**
     * @BeforeScenario
     */
    public function startCoverage(BeforeScenarioScope $scope)
    {
        $feature = $scope->getFeature()->getTitle();
        $title = $scope->getScenario()->getTitle();

        self::$coverage->start("{$feature}::{$title}");
    }

    /**
     * @AfterScenario
     */
    public function stopCoverage()
    {
        self::$coverage->stop();
    }
}
