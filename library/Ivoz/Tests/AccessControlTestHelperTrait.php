<?php

namespace Ivoz\Tests;

use Doctrine\Common\Collections\Criteria;
use Ivoz\Api\Core\Security\AccessControlEvaluator;
use Ivoz\Api\Core\Security\DataAccessControlParser;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\Model\Helper\CriteriaHelper;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorRepository;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Authentication\Token\JWTUserToken;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

trait AccessControlTestHelperTrait
{
    /**
     * @var KernelInterface
     */
    protected static $kernel;

    /**
     * @var ContainerInterface
     */
    protected $serviceContainer;

    /**
     * @var DataAccessControlParser
     */
    protected $dataAccessControlParser;

    protected $cacheDir;

    protected $fs;

    abstract protected function getResourceClass(): string;
    abstract protected function getAdminCriteria(): array;

    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $kernel = self::bootKernel();
        $this->cacheDir = $kernel->getCacheDir();
        $this->fs = new Filesystem();
        $this->resetDatabase();

        $this->serviceContainer = $kernel->getContainer();

        $request = new Request(
            [],
            [],
            [
                '_api_resource_class' => $this->getResourceClass(),
                '_api_item_operation_name' => 'something',
            ]
        );

        $this
            ->serviceContainer
            ->get('request_stack')
            ->push($request);

        $repository = $this->getRepository();

        /** @var AdministratorInterface | UserInterface $admin */
        $admin = $repository->findOneBy(
            $this->getAdminCriteria()
        );

        $adminToken = $this
            ->serviceContainer
            ->get(JWTTokenManagerInterface::class)
            ->create($admin);

        /** @var TokenStorage $token */
        $tokenStorage = $this
            ->serviceContainer
            ->get('security.token_storage');

        $tokenStorage->setToken(
            new JWTUserToken(
                $admin->getRoles(),
                $admin,
                $adminToken
            )
        );

        $this->dataAccessControlParser = $this
            ->serviceContainer
            ->get(DataAccessControlParser::class);

        $parserReflection = new \ReflectionClass(
            $this->dataAccessControlParser
        );

        $accessControlEvaluatorReflection = $parserReflection->getProperty('accessControlEvaluator');
        $accessControlEvaluatorReflection->setAccessible(true);

        $accessControllMock = $this
            ->getMockBuilder(AccessControlEvaluator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $accessControllMock
            ->expects($this->any())
            ->method('evaluate')
            ->will(
                $this->returnCallback(function (string $expression, array $variables): string {
                    return $expression;
                })
            );

        $accessControllMock
            ->expects($this->any())
            ->method('getForeginKeysByCriteria')
            ->will(
                $this->returnCallback(function (string $fqcn, Criteria $criteria): string {

                    $criteriaArray = CriteriaHelper::toArray($criteria);
                    $fqcnSegments = explode('\\', $fqcn);

                    return sprintf(
                        '%s(%s)',
                        end($fqcnSegments) . 'Repository',
                        json_encode($criteriaArray, JSON_THROW_ON_ERROR)
                    );
                })
            );

        $accessControlEvaluatorReflection->setValue(
            $this->dataAccessControlParser,
            $accessControllMock
        );
    }

    protected function getRepository()
    {
        return $this
            ->serviceContainer
            ->get(AdministratorRepository::class);
    }

    protected function resetDatabase()
    {
        $this->dropDatabase();
        $this->fs->copy(
            $this->cacheDir . DIRECTORY_SEPARATOR . 'db.sqlite.back',
            $this->cacheDir . DIRECTORY_SEPARATOR . '/db.sqlite'
        );
    }

    /**
     * @AfterScenario @dropSchema
     */
    public function dropDatabase()
    {
        $this->fs->remove(
            $this->cacheDir . DIRECTORY_SEPARATOR . 'db.sqlite'
        );
    }
}
