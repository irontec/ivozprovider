<?php

namespace Controller\Provider\Invoice;

use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Ivoz\Provider\Domain\Service\Invoice\Regenerate;

class RegenerateAction
{
    public function __construct(
        private TokenStorageInterface $tokenStorage,
        private InvoiceRepository $invoiceRepository,
        private Regenerate $invoiceRegenerator,
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        /** @var TokenInterface $token */
        $token =  $this->tokenStorage->getToken();
        /** @var AdministratorInterface $user */
        $user = $token->getUser();

        $id = (int) $request->attributes->get('id');

        /** @var ?InvoiceInterface $invoice */
        $invoice = $this->invoiceRepository->find($id);

        if (!$invoice) {
            throw new \RuntimeException(
                'Invoice not found',
                404
            );
        }

        $userBrandId = $user->getBrand()?->getId();
        $invoiceBrandId = $invoice->getBrand()->getId();

        if ($userBrandId !== $invoiceBrandId) {
            throw new AccessDeniedHttpException();
        }

        $this->invoiceRegenerator->execute(
            $invoice
        );

        return new JsonResponse(
            ['status' => 'OK'],
            200
        );
    }
}
