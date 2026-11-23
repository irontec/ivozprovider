<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Gesdinet\JWTRefreshTokenBundle\Entity\RefreshToken;

class JwtRefreshToken extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $tokens = [
            'alice-refresh-token' => 'alice@democompany.com',
            'bob-refresh-token' => 'bob@democompany.com',
            'dana-refresh-token' => 'dana@democompany.com',
        ];

        foreach ($tokens as $token => $username) {
            $refreshToken = new RefreshToken();
            $refreshToken->setRefreshToken($token);
            $refreshToken->setUsername($username);
            $refreshToken->setValid(new \DateTime('2099-01-01 00:00:00'));

            $manager->persist($refreshToken);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderUser::class,
        );
    }
}
