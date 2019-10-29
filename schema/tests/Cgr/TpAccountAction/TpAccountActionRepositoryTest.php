<?php

namespace Tests\Cgr\TpAccountAction;

use Ivoz\Cgr\Domain\Model\TpAccountAction\TpAccountActionInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Cgr\Domain\Model\TpAccountAction\TpAccountAction;
use Ivoz\Cgr\Domain\Model\TpAccountAction\TpAccountActionRepository;

class TpAccountActionRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function test_runner()
    {
        $this->its_instantiable();
    }

    public function its_instantiable()
    {
        /** @var TpAccountActionRepository $repository */
        $repository = $this
            ->em
            ->getRepository(TpAccountAction::class);

        $this->assertInstanceOf(
            TpAccountActionRepository::class,
            $repository
        );
    }

    public function its_finds_by_company()
    {
        /** @var TpAccountActionRepository $repository */
        $repository = $this
            ->em
            ->getRepository(TpAccountAction::class);

        $tpAccountAction = $repository->findOneBy(1);

        $this->assertInstanceOf(
            TpAccountAction::class,
            $tpAccountAction
        );
    }
}
