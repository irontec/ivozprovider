<?php

namespace Ivoz\Api\Core\Security;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use ApiPlatform\Core\Metadata\Resource\Factory\ResourceMetadataFactoryInterface;
use ApiPlatform\Core\Util\RequestAttributesExtractor;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Persistence\ObjectRepository;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\Model\Helper\CriteriaHelper;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class DataAccessControlParser
{
    const RAW_CONDITION_KEY = 'raw';

    const INHERITANCE_KEY = 'inherited';
    const INHERITANCE_OR_NULL_KEY = 'inheritedOrNull';

    const INHERITANCE_TYPES = [
        self::INHERITANCE_KEY,
        self::INHERITANCE_OR_NULL_KEY
    ];

    const READ_ACCESS_CONTROL_ATTRIBUTE = 'read_access_control';
    const WRITE_ACCESS_CONTROL_ATTRIBUTE = 'write_access_control';

    const ACCESS_CONTROL_TYPES = [
        self::READ_ACCESS_CONTROL_ATTRIBUTE,
        self::WRITE_ACCESS_CONTROL_ATTRIBUTE
    ];

    protected $requestStack;
    protected $tokenStorage;
    protected $resourceMetadataFactory;
    protected $accessControlEvaluator;

    protected $expressionCache = [];
    protected $repositories = [];

    public function __construct(
        RequestStack $requestStack,
        TokenStorage $tokenStorage,
        ResourceMetadataFactoryInterface $resourceMetadataFactory,
        AccessControlEvaluator $accessControlEvaluator
    ) {
        $this->requestStack = $requestStack;
        $this->tokenStorage = $tokenStorage;
        $this->resourceMetadataFactory = $resourceMetadataFactory;
        $this->accessControlEvaluator = $accessControlEvaluator;
    }

    public function addRepository(string $name, ObjectRepository $repository)
    {
        $this->repositories[$name] = $repository;
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

        $this->resetCache();
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

        if (empty($response) && $mode === self::WRITE_ACCESS_CONTROL_ATTRIBUTE) {
            /**
             * Use read access control as fallback
             */
            $response = $resourceMetadata->getAttribute(
                self::READ_ACCESS_CONTROL_ATTRIBUTE,
                []
            );
        }

        $response = $this->recursiveInheritanceParser($response, $role, $mode);

        if (isset($response[$role])) {
            return $response[$role];
        }

        return $response;
    }

    protected function resetCache()
    {
        $this->expressionCache = [];
    }

    protected function recursiveInheritanceParser(array $response, $role, $mode): array
    {
        $response = $response[$role] ?? $response;
        foreach ($response as $key => $value) {
            if (!is_array($value)) {
                continue;
            }

            if (in_array($key, self::INHERITANCE_TYPES, true)) {
                unset($response[$key]);
                $inheritedValues = $this->getInheritedAccessControl(
                    $value,
                    $role,
                    self::READ_ACCESS_CONTROL_ATTRIBUTE
                );
                $response += $inheritedValues;
            } else {
                $appendNull = key($value) === self::INHERITANCE_OR_NULL_KEY;
                $parsedInheritance = $this->recursiveInheritanceParser($value, $role, $mode);
                $response[$key] = $parsedInheritance;

                if ($appendNull) {
                    $parsedInheritanceKey = key($parsedInheritance);
                    $response[] = [$parsedInheritanceKey => ['isNull' => null]];
                }
            }
        }

        return $response;
    }

    /**
     * @param array $response
     * @return array
     */
    protected function getInheritedAccessControl(array $response, string $role, string $mode): array
    {
        $inheritedAccessControl = [];
        foreach ($response as $field => $resource) {
            $dataAccessControl = $this->getResourceDataAccessControl($resource, $role, $mode);
            if (empty($dataAccessControl)) {
                continue;
            }

            $parsedDataAccessControl = $this->parseDataAccessControl($dataAccessControl);
            $criteria = $this->dataAccessControlToCriteria($parsedDataAccessControl);
            $inheritedAccessControl[$field]['in'] = $this->accessControlEvaluator->getForeginKeysByCriteria(
                $resource,
                $criteria
            );
        }

        return $inheritedAccessControl;
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
        /** @var TokenInterface | null $token */
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
     * @param array $accessControl
     * @return array
     */
    protected function accessControlToArrayCriteria($accessControl): array
    {
        $arrayCriteria = [];
        foreach ($accessControl as $key => $value) {
            $isConditionWrapper = CriteriaHelper::isWrappedCondition($value);

            if ($isConditionWrapper) {
                $key = key($value);
                $value = current($value);
            }

            if (in_array($key, ['and', 'or'], true)) {
                $subCriteria = [];
                foreach ($value as $v) {
                    $parsedValue = $this->accessControlToArrayCriteria($v);
                    $subCriteria[] = current($parsedValue);
                }

                $arrayCriteria[] =  [$key => $subCriteria];
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
                ? $this->evaluateAndCacheExpression($value)
                : $this->parseDataAccessControl($value);
        }

        return $response;
    }

    /**
     * @param string $expression
     * @return mixed
     */
    protected function evaluateAndCacheExpression(string $expression)
    {
        $alreadyCached = array_key_exists(
            $expression,
            $this->expressionCache
        );

        if (!$alreadyCached) {
            $this->expressionCache[$expression] = $this
                ->accessControlEvaluator
                ->evaluate(
                    $expression,
                    $this->getVariables()
                );
        }

        return $this->expressionCache[$expression];
    }

    /**
     * @return array
     */
    protected function getVariables(): array
    {
        $request = $this->requestStack->getCurrentRequest();

        return $this->repositories + [
            'user' => $this->getUserOrThrowException(),
            'object' => $request->attributes->get('data'),

        ];
    }
}
