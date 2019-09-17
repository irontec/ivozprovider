<?php

namespace Tests\Provider\TrunksHtable;

use Ivoz\Kam\Domain\Model\TrunksHtable\TrunksHtableInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Kam\Domain\Model\TrunksHtable\TrunksHtable;
use Ivoz\Kam\Domain\Model\TrunksHtable\TrunksHtableRepository;

class TrunksHtableRepositoryTest extends KernelTestCase
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
        /** @var TrunksHtableRepository $repository */
        $repository = $this
            ->em
            ->getRepository(TrunksHtable::class);

        $this->assertInstanceOf(
            TrunksHtableRepository::class,
            $repository
        );
    }
}
