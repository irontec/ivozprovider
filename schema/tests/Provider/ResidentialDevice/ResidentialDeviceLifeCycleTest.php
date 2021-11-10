<?php

namespace Tests\Provider\ResidentialDevice;

use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpoint;
use Ivoz\Ast\Domain\Model\PsIdentify\PsIdentify;
use Ivoz\Ast\Domain\Model\Voicemail\Voicemail as AstVoicemail;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDevice;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceDto;
use Ivoz\Provider\Domain\Model\Voicemail\Voicemail;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;

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

        /////////////////////////////////
        ///
        /////////////////////////////////

        $this->it_triggers_lifecycle_services();
        $this->it_updates_ps_endpoint();
    }

    protected function it_triggers_lifecycle_services()
    {
        $this->assetChangedEntities([
            ResidentialDevice::class,
            PsEndpoint::class,
            PsIdentify::class,
            Voicemail::class,
            AstVoicemail::class,
        ]);
    }

    protected function it_updates_ps_endpoint()
    {
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
                'mailboxes' => 'residential2@company1',
                'direct_media' => 'yes',
                'direct_media_method' => 'invite',
                'send_diversion' => 'yes',
                'send_pai' => 'yes',
                '100rel' => 'no',
                'outbound_proxy' => 'sip:users.ivozprovider.local^3Blr',
                'trust_id_inbound' => 'yes',
                't38_udptl' => 'no',
                't38_udptl_ec' => 'redundancy',
                't38_udptl_maxdatagram' => 1440,
                't38_udptl_nat' => 'no',
                'residentialDeviceId' => 2,
                'id' => 6
            ]
        );
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
            PsEndpoint::class,
            AstVoicemail::class,
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
}
