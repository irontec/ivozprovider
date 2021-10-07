<?php

namespace Service;

use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallDto;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class BillableCallNormalizer implements NormalizerInterface
{
    protected $decoratedNormalizer;
    protected $tokenStorage;

    public function __construct(
        NormalizerInterface $decoratedNormalizer,
        TokenStorageInterface $tokenStorage
    ) {
        $this->decoratedNormalizer = $decoratedNormalizer;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null)
    {
        return $this
            ->decoratedNormalizer
            ->supportsNormalization(...func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function normalize($object, $format = null, array $context = [])
    {
        $response = $this
            ->decoratedNormalizer
            ->normalize(...func_get_args());

        if (
            ! $object instanceof BillableCallInterface
            && !$object instanceof BillableCallDto
        ) {
            return $response;
        }

        $token =  $this->tokenStorage->getToken();

        if (!$token || !$token->getUser()) {
            return $response;
        }

        /** @var AdministratorInterface $administrator */
        $administrator = $token->getUser();
        $company = $administrator->getCompany();

        if ($company->getShowInvoices()) {
            return $response;
        }

        if (isset($response['price'])) {
            // Remove price value
            $response['price'] = null;
        }

        return $response;
    }
}
