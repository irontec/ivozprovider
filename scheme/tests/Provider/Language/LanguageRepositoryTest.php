<?php

namespace Tests\Provider\Language;

use Ivoz\Provider\Domain\Model\Language\LanguageRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\Language\Language;

class LanguageRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function its_instantiable()
    {
        /** @var LanguageRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Language::class);

        $this->assertInstanceOf(
            LanguageRepository::class,
            $repository
        );
    }
}