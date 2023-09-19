<?php

namespace Tests\Provider\WebPortal;

use Ivoz\Provider\Domain\Model\WebPortal\WebPortalRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\WebPortal\WebPortal;

class WebPortalRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function test_runner()
    {
        $this->its_instantiable();
        $this->its_finds_user_web_portal_by_server_name();
        $this->its_finds_user_web_portal_by_server_name_and_type();
    }

    public function its_instantiable()
    {
        /** @var WebPortalRepository $repository */
        $repository = $this
            ->em
            ->getRepository(WebPortal::class);

        $this->assertInstanceOf(
            WebPortalRepository::class,
            $repository
        );
    }

    public function its_finds_user_web_portal_by_server_name()
    {
        /** @var WebPortalRepository $repository */
        $repository = $this
            ->em
            ->getRepository(WebPortal::class);

        $webPortal = $repository->findByServerName(
            'users-ivozprovider.irontec.com'
        );

        $this->assertInstanceOf(
            WebPortal::class,
            $webPortal
        );
    }

    public function its_finds_user_web_portal_by_server_name_and_type()
    {
        /** @var WebPortalRepository $repository */
        $repository = $this
            ->em
            ->getRepository(WebPortal::class);

        $webPortal = $repository->findByServerNameAndType(
            'users-ivozprovider.irontec.com',
            'user'
        );

        $this->assertInstanceOf(
            WebPortal::class,
            $webPortal
        );
    }
}
