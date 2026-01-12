<?php

namespace Tests\Provider\TransformationRuleSet;

use Ivoz\Provider\Domain\Model\TransformationRule\TransformationRule;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSet;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetDto;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;

class TransformationRuleSetLifeCycleTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @return TransformationRuleSetDto
     */
    protected function getTransformationRuleSetDto()
    {
        $transformationRuleSetDto = new TransformationRuleSetDto();
        $transformationRuleSetDto
            ->setDescription("Test transformation")
            ->setGenerateRules(true)
            ->setNameEn('en')
            ->setNameEs('es')
            ->setNameCa('ca')
            ->setNameIt('it')
            ->setNameEu('eu')
            ->setCountryId(1);

        return $transformationRuleSetDto;
    }

    protected function addTransformationRuleSet()
    {
        $dto = $this->getTransformationRuleSetDto();
        return $this
            ->entityTools
            ->persistDto($dto, null, true);
    }

    protected function updateTransformationRuleSet()
    {
        $transformationRuleSetRepository = $this->em
            ->getRepository(TransformationRuleSet::class);

        $transformationRuleSet = $transformationRuleSetRepository->find(1);

        /** @var TransformationRuleSetDto $transformationRuleSetDto */
        $transformationRuleSetDto = $this->entityTools->entityToDto(
            $transformationRuleSet
        );

        $transformationRuleSetDto
            ->setNameEn('UpdatedNameEn')
            ->setGenerateRules(true);

        return $this
            ->entityTools
            ->persistDto($transformationRuleSetDto, $transformationRuleSet, true);
    }

    protected function removeTransformationRuleSet()
    {
        $transformationRuleSetRepository = $this->em
            ->getRepository(TransformationRuleSet::class);

        $transformationRuleSet = $transformationRuleSetRepository->find(1);

        return $this
            ->entityTools
            ->remove($transformationRuleSet);
    }

    /**
     * @test
     */
    public function it_persists_transformation_rule_set()
    {
        $transformationRuleSetRepository = $this->em
            ->getRepository(TransformationRuleSet::class);

        $fixtureTransformationRuleSet = $transformationRuleSetRepository->findAll();

        $this->addTransformationRuleSet();

        $transformationRuleSets = $transformationRuleSetRepository->findAll();
        $this->assertCount(
            count($fixtureTransformationRuleSet) + 1,
            $transformationRuleSets
        );

        /////////////////////////////////
        ///
        /////////////////////////////////

        $this->it_triggers_lifecycle_services();
    }

    protected function it_triggers_lifecycle_services()
    {
        $this->assetChangedEntities([
            TransformationRuleSet::class,
            TransformationRule::class,
        ]);
    }

    /**
     * @test
     */
    public function it_triggers_update_lifecycle_services()
    {
        $this->updateTransformationRuleSet();
        $this->assetChangedEntities([
            TransformationRuleSet::class,
            TransformationRule::class,
        ]);
    }

    /**
     * @test
     */
    public function it_triggers_remove_lifecycle_services()
    {
        $this->removeTransformationRuleSet();
        $this->assetChangedEntities([
            TransformationRuleSet::class
        ]);
    }
}
