<?php

namespace Controller\My;

use Ivoz\Provider\Domain\Model\FaxesInOut\FaxesInOutInterface;
use Ivoz\Provider\Domain\Model\FaxesInOut\FaxesInOutRepository;
use Ivoz\Provider\Domain\Service\FaxesInOut\ResendFax;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PostFaxResendAction
{
    public function __construct(
        private readonly FaxesInOutRepository $faxesInOutRepository,
        private readonly ResendFax $resendFax
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $id = $request->attributes->getInt('id');

        /** @var FaxesInOutInterface|null $faxesInOut*/
        $faxesInOut = $this->faxesInOutRepository->find($id);

        if ($faxesInOut === null) {
            throw new \DomainException(
                'Item not found',
                404
            );
        }

        try {
            $this->resendFax->execute($faxesInOut);
        } catch (\DomainException $e) {
            return new Response(
                $e->getMessage(),
                $e->getCode()
            );
        } catch (\Exception $e) {
            return new Response(
                'Fax resend failed',
                500
            );
        }

        return new Response(
            'Fax successfully resent',
            200
        );
    }
}
