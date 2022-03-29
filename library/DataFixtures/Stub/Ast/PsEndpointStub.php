<?php

namespace DataFixtures\Stub\Ast;

use DataFixtures\Stub\StubTrait;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpoint;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointDto;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface;

class PsEndpointStub
{
    use StubTrait;

    protected function getEntityName(): string
    {
        return PsEndpoint::class;
    }

    protected function load()
    {
        $dto = (new PsEndpointDto(1))
            ->setSorceryId('b1c1t1_alice')
            ->setAors('b1c1t1_alice')
            ->setContext('')
            ->setCallerid('Alice  <101>')
            ->setAllow('alaw')
            ->setDisallow('')
            ->setDirectMedia(null)
            ->setDirectMediaMethod('invite')
            ->setMailboxes('101@company1')
            ->setNamedPickupGroup('')
            ->setOneHundredRel(
                PsEndpointInterface::ONEHUNDREDREL_NO
            )
            ->setT38Udptl(PsEndpointInterface::T38UDPTL_NO)
            ->setT38UdptlEc(PsEndpointInterface::T38UDPTLEC_REDUNDANCY)
            ->setT38UdptlMaxdatagram(0)
            ->setT38UdptlNat(PsEndpointInterface::T38UDPTLNAT_NO)
            ->setTerminalId(
                1
            );
        $this->append($dto);

        $dto = (new PsEndpointDto(2))
            ->setSorceryId('b1c1t2_bob')
            ->setAors('b1c1t2_bob')
            ->setContext('')
            ->setCallerid('Bob  <102>')
            ->setAllow('alaw')
            ->setDisallow('')
            ->setDirectMedia(null)
            ->setDirectMediaMethod('invite')
            ->setMailboxes('102@company1')
            ->setNamedPickupGroup('')
            ->setOneHundredRel(
                PsEndpointInterface::ONEHUNDREDREL_NO
            )
            ->setT38Udptl(PsEndpointInterface::T38UDPTL_NO)
            ->setT38UdptlEc(PsEndpointInterface::T38UDPTLEC_REDUNDANCY)
            ->setT38UdptlMaxdatagram(0)
            ->setT38UdptlNat(PsEndpointInterface::T38UDPTLNAT_NO)
            ->setTerminalId(
                2
            );
        $this->append($dto);

        $dto = (new PsEndpointDto(3))
            ->setSorceryId('b1c1t3_testTerminal')
            ->setFromDomain('127.0.0.1')
            ->setAors('b1c1t3_testTerminal')
            ->setContext('')
            ->setAllow('alaw')
            ->setDisallow('')
            ->setDirectMediaMethod('invite')
            ->setOutboundProxy('sip:users.ivozprovider.local^3Blr')
            ->setOneHundredRel(
                PsEndpointInterface::ONEHUNDREDREL_NO
            )
            ->setT38Udptl(PsEndpointInterface::T38UDPTL_NO)
            ->setT38UdptlEc(PsEndpointInterface::T38UDPTLEC_REDUNDANCY)
            ->setT38UdptlMaxdatagram(0)
            ->setT38UdptlNat(PsEndpointInterface::T38UDPTLNAT_NO)
            ->setTerminalId(
                3
            );
        $this->append($dto);

        $dto = (new PsEndpointDto(4))
            ->setSorceryId('b1c1f1_testFriend')
            ->setFromDomain('127.0.0.1')
            ->setAors('b1c1f1_testFriend')
            ->setContext('friends')
            ->setAllow('alaw')
            ->setDisallow('')
            ->setDirectMediaMethod('invite')
            ->setOutboundProxy('sip:users.ivozprovider.local^3Blr')
            ->setTrustIdInbound('yes')
            ->setOneHundredRel(
                PsEndpointInterface::ONEHUNDREDREL_NO
            )
            ->setT38Udptl(PsEndpointInterface::T38UDPTL_NO)
            ->setT38UdptlEc(PsEndpointInterface::T38UDPTLEC_REDUNDANCY)
            ->setT38UdptlMaxdatagram(0)
            ->setT38UdptlNat(PsEndpointInterface::T38UDPTLNAT_NO)
            ->setFriendId(
                1
            );
        $this->append($dto);

        $dto = (new PsEndpointDto(5))
            ->setSorceryId('b1c1r5_testResidential')
            ->setFromDomain('127.0.0.1')
            ->setAors('b1c1f1_testResidential')
            ->setContext('residential')
            ->setAllow('alaw')
            ->setDisallow('')
            ->setDirectMediaMethod('invite')
            ->setOutboundProxy('sip:users.ivozprovider.local^3Blr')
            ->setTrustIdInbound('yes')
            ->setMailboxes('residential1@company1')
            ->setOneHundredRel(
                PsEndpointInterface::ONEHUNDREDREL_NO
            )
            ->setT38Udptl(PsEndpointInterface::T38UDPTL_NO)
            ->setT38UdptlEc(PsEndpointInterface::T38UDPTLEC_REDUNDANCY)
            ->setT38UdptlMaxdatagram(0)
            ->setT38UdptlNat(PsEndpointInterface::T38UDPTLNAT_NO)
            ->setResidentialDeviceId(
                1
            );
        $this->append($dto);
    }
}
