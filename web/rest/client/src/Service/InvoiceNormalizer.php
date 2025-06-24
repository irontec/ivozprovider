<?php

namespace Service;

use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceDto;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class InvoiceNormalizer implements NormalizerInterface
{
    public function __construct(
        private NormalizerInterface $decoratedNormalizer,
        private TokenStorageInterface $tokenStorage
    ) {
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null, array $context = []): bool
    {
        return $this
            ->decoratedNormalizer
            ->supportsNormalization($data, $format);
    }

    /**
     * {@inheritdoc}
     */
    public function normalize($object, $format = null, array $context = [])
    {
        $response = $this
            ->decoratedNormalizer
            ->normalize($object, $format, $context);

        if (
            ! $object instanceof InvoiceInterface
            && !$object instanceof InvoiceDto
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

        if (isset($response['total'])) {
            $response['total'] = null;
        }

        if (isset($response['totalWithTax'])) {
            $response['totalWithTax'] = null;
        }

        if (isset($response['taxRate'])) {
            $response['taxRate'] = null;
        }

        return $response;
    }
} 