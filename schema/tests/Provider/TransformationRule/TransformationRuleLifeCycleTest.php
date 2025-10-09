<?php

namespace Tests\Provider\TransformationRule;

use Ivoz\Provider\Domain\Model\TransformationRule\TransformationRule;
use Ivoz\Provider\Domain\Model\TransformationRule\TransformationRuleDto;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;

class TransformationRuleLifeCycleTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @return TransformationRuleDto
     */
    protected function getTransformationRuleDto()
    {
        $transformationRuleDto = new TransformationRuleDto();
        $transformationRuleDto
            ->setType('callerout')
            ->setDescription('From e164 to special national')
            ->setPriority(3)
            ->setMatchExpr('^\+349([0-9]+)\$')
            ->setReplaceExpr('\1')
            ->setTransformationRuleSetId(1);

        return $transformationRuleDto;
    }

    protected function addTransformationRule()
    {
        $dto = $this->getTransformationRuleDto();
        return $this
            ->entityTools
            ->persistDto(
                $dto,
                null,
                true
            );
    }

    protected function updateTransformationRule()
    {
        $transformationRuleRepository = $this->em
            ->getRepository(TransformationRule::class);

        /** @var TransformationRule $transformationRule */
        $transformationRule = $transformationRuleRepository->find(1);

        /** @var TransformationRuleDto $transformationRuleDto */
        $transformationRuleDto = $this->entityTools->entityToDto(
            $transformationRule
        );

        $transformationRuleDto
            ->setType('callerin');

        return $this
            ->entityTools
            ->persistDto($transformationRuleDto, $transformationRule, true);
    }

    protected function removeTransformationRule()
    {
        $transformationRuleRepository = $this->em
            ->getRepository(TransformationRule::class);

        /** @var TransformationRule $transformationRule */
        $transformationRule = $transformationRuleRepository->find(1);

        return $this
            ->entityTools
            ->remove($transformationRule);
    }

    /**
     * @test
     */
    public function it_persists_routing_tags()
    {
        $transformationRuleRepository = $this->em
            ->getRepository(TransformationRule::class);

        $fixtureTransformationRule = $transformationRuleRepository->findAll();

        $this->addTransformationRule();

        $transformationRules = $transformationRuleRepository->findAll();
        $this->assertCount(
            count($fixtureTransformationRule) + 1,
            $transformationRules
        );

        /////////////////////////////////
        ///
        /////////////////////////////////

        $this->it_triggers_lifecycle_services();
    }

    protected function it_triggers_lifecycle_services()
    {
        $this->assetChangedEntities([
            TransformationRule::class
        ]);
    }

    /**
     * @test
     */
    public function it_triggers_update_lifecycle_services()
    {
        $this->updateTransformationRule();
        $this->assetChangedEntities([
            TransformationRule::class
        ]);
    }

    /**
     * @test
     */
    public function it_triggers_remove_lifecycle_services()
    {
        $this->removeTransformationRule();
        $this->assetChangedEntities([
            TransformationRule::class
        ]);
    }

    /**
     * @test
     */
    public function it_validates_invalid_regex_pattern()
    {
        $this->expectExceptionMessageMatches(
            '/"\/\\[A-Z\\+\/" is not a valid regexp/'
        );

        $transformationRuleDto = new TransformationRuleDto();
        $transformationRuleDto
            ->setType('callerout')
            ->setDescription('Invalid regex test')
            ->setPriority(1)
            ->setMatchExpr('[A-Z+')
            ->setReplaceExpr('test')
            ->setTransformationRuleSetId(1);

        $this->entityTools->persistDto($transformationRuleDto, null, true);
    }

    /**
     * @test
     */
    public function it_validates_backreference_without_capture_groups()
    {
        $this->expectExceptionMessageMatches(
            '/Replace expression contains backreference \\\\1 but match expression only has 0 capture groups/'
        );

        $transformationRuleDto = new TransformationRuleDto();
        $transformationRuleDto
            ->setType('callerout')
            ->setDescription('Backreference without capture groups')
            ->setPriority(1)
            ->setMatchExpr('[0-9]+')
            ->setReplaceExpr('prefix_\1_suffix')
            ->setTransformationRuleSetId(1);

        $this->entityTools->persistDto($transformationRuleDto, null, true);
    }

    /**
     * @test
     */
    public function it_validates_backreference_exceeds_capture_groups()
    {
        $this->expectExceptionMessageMatches(
            '/Replace expression contains backreference \\\\3 but match expression only has 2 capture groups/'
        );

        $transformationRuleDto = new TransformationRuleDto();
        $transformationRuleDto
            ->setType('callerout')
            ->setDescription('Backreference exceeds capture groups')
            ->setPriority(1)
            ->setMatchExpr('^([0-9]+)-([a-z]+)$')
            ->setReplaceExpr('\\1_\\2_\\3')
            ->setTransformationRuleSetId(1);

        $this->entityTools->persistDto($transformationRuleDto, null, true);
    }

    /**
     * @test
     */
    public function it_allows_valid_backreferences()
    {
        $transformationRuleDto = new TransformationRuleDto();
        $transformationRuleDto
            ->setType('callerout')
            ->setDescription('Valid backreferences')
            ->setPriority(1)
            ->setMatchExpr('^([0-9]+)-([a-z]+)-([A-Z]+)$')
            ->setReplaceExpr('\3_\2_\1')
            ->setTransformationRuleSetId(1);

        $result = $this->entityTools->persistDto($transformationRuleDto, null, true);
        $this->assertNotNull($result);
    }

    /**
     * @test
     */
    public function it_allows_replace_without_backreferences()
    {
        $transformationRuleDto = new TransformationRuleDto();
        $transformationRuleDto
            ->setType('callerout')
            ->setDescription('No backreferences')
            ->setPriority(1)
            ->setMatchExpr('([0-9]+)')
            ->setReplaceExpr('nobackreferences')
            ->setTransformationRuleSetId(1);

        $result = $this->entityTools->persistDto($transformationRuleDto, null, true);
        $this->assertNotNull($result);
    }
}
