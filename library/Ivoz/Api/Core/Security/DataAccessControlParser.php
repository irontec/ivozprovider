<?php

namespace Ivoz\Api\Core\Security;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use ApiPlatform\Core\Metadata\Resource\Factory\ResourceMetadataFactoryInterface;
use ApiPlatform\Core\Util\RequestAttributesExtractor;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManager;
use Ivoz\Provider\Domain\Model\Company\CompanyRepository;
use Ivoz\Provider\Domain\Model\User\UserRepository;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\User\UserInterface;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\Model\Helper\CriteriaHelper;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

class DataAccessControlParser
{
    const RAW_CONDITION_KEY = 'raw';

    const INHERITANCE_KEY = 'inherited';

    const READ_ACCESS_CONTROL_ATTRIBUTE = 'read_access_control';

    const WRITE_ACCESS_CONTROL_ATTRIBUTE = 'write_access_control';

    const ACCESS_CONTROL_TYPES = [
        self::READ_ACCESS_CONTROL_ATTRIBUTE,
        self::WRITE_ACCESS_CONTROL_ATTRIBUTE
    ];

    /**
     * @var RequestStack
     */
    protected $requestStack;

    /**
     * @var TokenStorage
     */
    protected $tokenStorage;

    /**
     * @var ResourceMetadataFactoryInterface
     */
    protected $resourceMetadataFactory;

    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @var CompanyRepository
     */
    protected $companyRepository;

    public function __construct(
        RequestStack $requestStack,
        TokenStorage $tokenStorage,
        ResourceMetadataFactoryInterface $resourceMetadataFactory,
        EntityManager $entityManager,
        UserRepository $userRepository,
        CompanyRepository $companyRepository
    ) {
        $this->requestStack = $requestStack;
        $this->tokenStorage = $tokenStorage;
        $this->resourceMetadataFactory = $resourceMetadataFactory;
        $this->em = $entityManager;
        $this->userRepository = $userRepository;
        $this->companyRepository = $companyRepository;
    }

    /**
     * @return array
     */
    public function get($mode = self::READ_ACCESS_CONTROL_ATTRIBUTE)
    {
        $role = $this->getUserRoleOrThrowException();
        $request = $this->requestStack->getCurrentRequest();
        if (!$attributes = RequestAttributesExtractor::extractAttributes($request)) {
            throw new \DomainException('Unable to resolve request attributes');
        }

        $resourceDataAccessControl = $this->getResourceDataAccessControl(
            $attributes['resource_class'],
            $role,
            $mode
        );

        $parsedDataAccessControl = $this->parseDataAccessControl(
            $resourceDataAccessControl
        );

        return $this->accessControlToArrayCriteria(
            $parsedDataAccessControl
        );
    }

    /**
     * @param string $resourceClass
     * @param string $role
     * @param string $mode
     * @return array
     */
    protected function getResourceDataAccessControl(string $resourceClass, string $role, string $mode): array
    {
        if (!in_array($mode, self::ACCESS_CONTROL_TYPES)) {
            throw new \InvalidArgumentException('Unknow access control attribute ' .  $mode);
        }

        $resourceMetadata = $this->resourceMetadataFactory->create(
            $resourceClass
        );

        $response = $resourceMetadata->getAttribute(
            $mode,
            []
        );

        if (empty($response) && $mode == self::WRITE_ACCESS_CONTROL_ATTRIBUTE) {
            /**
             * Use read access control as fallback
             */
            $response = $resourceMetadata->getAttribute(
                self::READ_ACCESS_CONTROL_ATTRIBUTE,
                []
            );
        }

        if (key($response) === self::INHERITANCE_KEY) {
            return $this->getInheritedAccessControl($response, $role, $mode);
        }

        if (!isset($response[$role])) {
            return [];
        }

        return $response[$role];
    }

    /**
     * @param array $response
     * @return array
     */
    protected function getInheritedAccessControl(array $response, string $role, string $mode): array
    {
        $inheritedAccessControl = [];
        foreach ($response['inherited'] as $field => $resource) {
            $dataAccessControl = $this->getResourceDataAccessControl($resource, $role, $mode);
            if (empty($dataAccessControl)) {
                continue;
            }

            $parsedDataAccessControl = $this->parseDataAccessControl($dataAccessControl);
            $criteria = $this->dataAccessControlToCriteria($parsedDataAccessControl);
            $inheritedAccessControl[$field]['in'] = $this->getEntityIdsByCriteria($resource, $criteria);
        }

        return $inheritedAccessControl;
    }

    protected function getEntityIdsByCriteria(string $fqcn, Criteria $criteria)
    {
        $entityRepository = $this->em->getRepository($fqcn);
        $qb = $entityRepository->createQueryBuilder('self');

        $qb
            ->select('self.id')
            ->addCriteria($criteria);

        $result = $qb
            ->getQuery()
            ->getScalarResult();

        return array_column($result, 'id');
    }

    /**
     * @return string
     * @throws ResourceClassNotFoundException
     */
    protected function getUserRoleOrThrowException(): string
    {
        $roles = $this->getUserOrThrowException()->getRoles();

        if (empty($roles)) {
            throw new \DomainException('Empty user rols');
        }

        return current($roles);
    }

    /**
     * @return UserInterface
     */
    protected function getUserOrThrowException(): UserInterface
    {
        /** @var TokenInterface $token */
        $token = $this->tokenStorage->getToken();

        if (!$token || !$token->getUser()) {
            throw new \DomainException('User not found');
        }

        return $token->getUser();
    }

    /**
     * @param array $dataAccessControl
     * @return Criteria
     */
    protected function dataAccessControlToCriteria(array $dataAccessControl): Criteria
    {
        if (empty($dataAccessControl)) {
            return Criteria::create();
        }

        return CriteriaHelper::fromArray(
            $this->accessControlToArrayCriteria($dataAccessControl)
        );
    }

    /**
     * @param $accessControl
     * @return array
     */
    protected function accessControlToArrayCriteria($accessControl): array
    {
        $arrayCriteria = [];
        foreach ($accessControl as $key => $value) {
            if (in_array($key, ['and', 'or'], true)) {
                $subCriteria = [];
                foreach ($value as $v) {
                    $parsedValue = $this->accessControlToArrayCriteria($v);
                    $subCriteria[] = current($parsedValue);
                }

                $arrayCriteria[$key] =  $subCriteria;
                continue;
            }

            if ($key === self::RAW_CONDITION_KEY) {
                $arrayCriteria[] = $value;
                continue;
            }

            if (!is_array($value)) {
                throw new \RuntimeException(
                    "Array value excepted at " . __FILE__ . ":" . __LINE__
                );
            }

            $arrayCriteria[] = [
                $key, key($value), current($value)
            ];
        }

        return $arrayCriteria;
    }

    /**
     * @param array $dataAccessControl
     * @return array
     */
    protected function parseDataAccessControl(array $dataAccessControl): array
    {
        $response = [];
        foreach ($dataAccessControl as $key => $value) {
            if ($key === self::RAW_CONDITION_KEY) {
                $response[$key] = $value;
                continue;
            }

            if (is_null($value)) {
                $response[$key] = $value;
                continue;
            }

            $response[$key] = is_scalar($value)
                ? $this->evaluateExpression($value)
                : $this->parseDataAccessControl($value);
        }

        return $response;
    }

    /**
     * @param string $expression
     * @return mixed
     */
    protected function evaluateExpression(string $expression)
    {
        $expressionLanguage = new ExpressionLanguage();

        return $expressionLanguage->evaluate(
            $expression,
            $this->getVariables()
        );
    }

    /**
     * @return array
     */
    protected function getVariables(): array
    {
        $request = $this->requestStack->getCurrentRequest();

        return [
            'user' => $this->getUserOrThrowException(),
            'object' => $request->attributes->get('data'),
            'userRepository' => $this->userRepository,
            'companyRepository' => $this->companyRepository
        ];
    }
}
