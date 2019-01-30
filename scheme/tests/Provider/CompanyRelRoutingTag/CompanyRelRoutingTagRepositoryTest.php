<?php

namespace Tests\Provider\CompanyRelRoutingTag;

use Ivoz\Provider\Domain\Model\CompanyRelRoutingTag\CompanyRelRoutingTagRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\CompanyRelRoutingTag\CompanyRelRoutingTag;

class CompanyRelRoutingTagRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function its_instantiable()
    {
        /** @var CompanyRelRoutingTagRepository $repository */
        $repository = $this
            ->em
            ->getRepository(CompanyRelRoutingTag::class);

        $this->assertInstanceOf(
            CompanyRelRoutingTagRepository::class,
            $repository
        );
    }
}
