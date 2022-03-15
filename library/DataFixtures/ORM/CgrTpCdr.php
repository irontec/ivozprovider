<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Cgr\Domain\Model\TpCdr\TpCdr;
use Ivoz\Cgr\Domain\Model\TpCdr\TpCdrInterface;

class CgrTpCdr extends Fixture
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(TpCdr::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var TpCdrInterface $item1 */
        $item1 = $this->createEntityInstance(TpCdr::class);
        (function () use ($fixture) {

            $this->setCgrid('5a364b1fe35e00fb2ac1923b43f84eeb78400e01');
            $this->setRunId('*raw');
            $this->setOriginHost('127.0.0.1');
            $this->setSource('KAMAILIO_CGR_CALL_END');
            $this->setOriginId('68375a3a-e7e0-4f63-ab3b-338cc007d19b;971b42ee-668c-415e-9e6c-6054846158b1');
            $this->setTor('*voice');
            $this->setRequestType('*postpaid');
            $this->setTenant('b1');
            $this->setCategory('call');
            $this->setAccount('c1');
            $this->setSubject('c1');
            $this->setDestination('+34911233915');
            $this->setSetupTime(new \DateTime('2021-11-09 05:44:14'));
            $this->setAnswerTime(new \DateTime('2021-11-09 05:44:23'));
            $this->setUsage('43000000000');
            $this->setExtraFields('{}');
            $this->setCost(-1);
            $this->setCostSource('');
            $this->setCostDetails([]);
            $this->setExtraInfo('');
            $this->setCreatedAt(new \DateTime('2021-11-09 05:45:07'));
            $this->setUpdatedAt(new \DateTime('2021-11-09 05:45:07'));
        })->call($item1);

        $this->addReference('_reference_CgrTpCdr1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        /////////////////////////
        ///
        ////////////////////////

        /** @var TpCdrInterface $item2 */
        $item2 = $this->createEntityInstance(TpCdr::class);
        (function () use ($fixture) {

            $this->setCgrid('5a364b1fe35e00fb2ac1923b43f84eeb78400e01');
            $this->setRunId('*default');
            $this->setOriginHost('127.0.0.1');
            $this->setSource('KAMAILIO_CGR_CALL_END');
            $this->setOriginId('68375a3a-e7e0-4f63-ab3b-338cc007d19b;971b42ee-668c-415e-9e6c-6054846158b1');
            $this->setTor('*voice');
            $this->setRequestType('*postpaid');
            $this->setTenant('b1');
            $this->setCategory('call');
            $this->setAccount('c1');
            $this->setSubject('c1');
            $this->setDestination('+34911233915');
            $this->setSetupTime(new \DateTime('2021-11-09 05:44:14'));
            $this->setAnswerTime(new \DateTime('2021-11-09 05:44:23'));
            $this->setUsage('43000000000');
            $this->setExtraFields('{}');
            $this->setCost(-1);
            $this->setCostSource('');
            $this->setCostDetails([]);
            $this->setExtraInfo('');
            $this->setCreatedAt(new \DateTime('2021-11-09 05:45:07'));
            $this->setUpdatedAt(new \DateTime('2021-11-09 05:45:07'));
        })->call($item2);

        $this->addReference('_reference_CgrTpCdr2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        /////////////////////////
        ///
        ////////////////////////

        /** @var TpCdrInterface $item3 */
        $item3 = $this->createEntityInstance(TpCdr::class);
        (function () use ($fixture) {

            $this->setCgrid('5a364b1fe35e00fb2ac1923b43f84eeb78400e03');
            $this->setRunId('*raw');
            $this->setOriginHost('127.0.0.1');
            $this->setSource('KAMAILIO_CGR_CALL_END');
            $this->setOriginId('68375a3a-e7e0-4f63-ab3b-338cc007d19b;971b42ee-668c-415e-9e6c-6054846158b1');
            $this->setTor('*voice');
            $this->setRequestType('*postpaid');
            $this->setTenant('b1');
            $this->setCategory('call');
            $this->setAccount('c1');
            $this->setSubject('c1');
            $this->setDestination('+34911233915');
            $this->setSetupTime(new \DateTime('2021-12-09 05:44:14'));
            $this->setAnswerTime(new \DateTime('2021-12-09 05:44:23'));
            $this->setUsage('43000000000');
            $this->setExtraFields('{}');
            $this->setCost(-1);
            $this->setCostSource('');
            $this->setCostDetails([]);
            $this->setExtraInfo('');
            $this->setCreatedAt(new \DateTime('2021-12-09 05:45:07'));
            $this->setUpdatedAt(new \DateTime('2021-12-09 05:45:07'));
        })->call($item3);

        $this->addReference('_reference_CgrTpCdr3', $item3);
        $this->sanitizeEntityValues($item3);
        $manager->persist($item3);

        $manager->flush();
    }
}
