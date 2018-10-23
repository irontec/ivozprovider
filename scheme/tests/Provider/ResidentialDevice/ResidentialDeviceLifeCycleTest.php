<?php

namespace Tests\Provider\ResidentialDevice;

use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpoint;
use Ivoz\Ast\Domain\Model\Voicemail\Voicemail;
use Ivoz\Cgr\Domain\Model\TpResidentialDevice\TpResidentialDevice;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceDto;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDevice;


class ResidentialDeviceLifeCycleTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @return ResidentialDeviceDto
     */
    protected function createDto()
    {
        $residentialDeviceDto = new ResidentialDeviceDto();
        $residentialDeviceDto
            ->setName('testResidentialDevice')
            ->setTransport('udp')
            ->setAuthNeeded('yes')
            ->setDisallow('all')
            ->setAllow('alaw')
            ->setDirectMediaMethod('invite')
            ->setCalleridUpdateHeader('pai')
            ->setUpdateCallerid('yes')
            ->setDirectConnectivity('yes')
            ->setBrandId(1)
            ->setCompanyId(1);

        return $residentialDeviceDto;
    }

    /**
     * @return ResidentialDevice
     */
    protected function addResidentialDevice()
    {
        $residentialDeviceDto = $this->createDto();

        /** @var ResidentialDevice $residentialDevice */
        $residentialDevice = $this->entityTools
            ->persistDto($residentialDeviceDto, null, true);

        return $residentialDevice;
    }


    protected function updateResidentialDevice()
    {
        $residentialDeviceRepository = $this->em
            ->getRepository(ResidentialDevice::class);

        $residentialDevice = $residentialDeviceRepository->find(1);

        /** @var ResidentialDeviceDto $residentialDeviceDto */
        $residentialDeviceDto = $this->entityTools->entityToDto($residentialDevice);

        $residentialDeviceDto
            ->setDirectMediaMethod('update');

        return $this
            ->entityTools
            ->persistDto($residentialDeviceDto, $residentialDevice, true);
    }

    protected function removeResidentialDevice()
    {
        $residentialDeviceRepository = $this->em
            ->getRepository(ResidentialDevice::class);

        $residentialDevice = $residentialDeviceRepository->find(1);

        $this
            ->entityTools
            ->remove($residentialDevice);
    }


    /**
     * @test
     */
    public function it_persists_residentialDevices()
    {
        $residentialDevice = $this->em
            ->getRepository(ResidentialDevice::class);
        $fixtureResidentialDevices = $residentialDevice->findAll();
        $this->assertCount(1, $fixtureResidentialDevices);

        $this->addResidentialDevice();

        $brands = $residentialDevice->findAll();
        $this->assertCount(2, $brands);
    }

    /**
     * @test
     */
    public function it_triggers_lifecycle_services()
    {
        $this->addResidentialDevice();
        $this->assetChangedEntities([
            ResidentialDevice::class,
            PsEndpoint::class,
            Voicemail::class
        ]);
    }

    /**
     * @test
     */
    public function it_triggers_update_lifecycle_services()
    {
        $this->updateResidentialDevice();
        $this->assetChangedEntities([
            ResidentialDevice::class,
            Voicemail::class,
            PsEndpoint::class
        ]);
    }

    /**
     * @test
     */
    public function it_triggers_remove_lifecycle_services()
    {
        $this->removeResidentialDevice();
        $this->assetChangedEntities([
            ResidentialDevice::class,
        ]);
    }

    /////////////////////////////////////////
    ///
    /////////////////////////////////////////

    /**
     * @test
     * @deprecated
     */
    public function it_updates_tp_rating_profile()
    {
        $this->addResidentialDevice();

        /** @var Changelog[] $changelogEntries */
        $changelogEntries = $this->getChangelogByClass(
            PsEndpoint::class
        );

        $this->assertCount(1, $changelogEntries);
        $changelog = $changelogEntries[0];

        $this->assertEquals(
            $changelog->getData(),
            [
                'sorcery_id' => 'b1c1r2_testResidentialDevice',
                'from_domain' => 'retail.irontec.com',
                'aors' => 'b1c1r2_testResidentialDevice',
                'context' => 'residential',
                'disallow' => 'all' ,
                'allow' => 'alaw',
                'direct_media' => 'yes',
                'direct_media_method' => 'invite',
                'send_diversion' => 'yes',
                'send_pai' => 'yes',
                '100rel' => 'no',
                'outbound_proxy' => 'sip:users.ivozprovider.local^3Blr',
                'trust_id_inbound' => 'yes',
                'residentialDeviceId' => 2,
                'id' => 6
            ]
        );
    }
}