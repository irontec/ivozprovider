<?php

use IvozProvider\Service\RestClient;
use Ivoz\Provider\Domain\Model\RatingProfile\RatingProfile;
use Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroup;
use Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileDto;
use Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupDto;

class KlearCustomDownloadRatingPlanController extends Zend_Controller_Action
{
    protected $_mainRouter;

    public function init()
    {
        if ((!$this->_mainRouter = $this->getRequest()->getUserParam("mainRouter")) || (!is_object($this->_mainRouter))) {
            throw new Zend_Exception('', Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION);
        }

        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
    }

    public function exportToCsvAction()
    {
        $auth = Zend_Auth::getInstance();
        if (!$auth->hasIdentity()) {
            throw new Klear_Exception_Default("Session expired");
        }
        $user = $auth->getIdentity();

        $apiClient = new RestClient(
            $user->token,
            $user->refreshToken
        );

        $dataGateway = Zend_Registry::get('data_gateway');
        /** @var RatingProfileDto $ratingProfileDto */
        $ratingProfileDto = $dataGateway->find(
            RatingProfile::class,
            $this->_request->getParam('pk')
        );

        /** @var RatingPlanGroupDto $ratingPlanGroupDto */
        $ratingPlanGroupDto = $dataGateway->find(
            RatingPlanGroup::class,
            $ratingProfileDto->getRatingPlanGroupId()
        );

        $now = new \DateTime();
        $fileName =
            $ratingPlanGroupDto->getNameEn()
            . '_'
            . $now->format('Ymd');

        $billableCalls = $apiClient->getRatingPlans($ratingPlanGroupDto->getId());

        $response = $this->getResponse();
        $response->clearHeaders();
        $response->setHeader('Content-Length', mb_strlen($billableCalls));
        $response->setHeader('Content-Type', 'text/csv');
        $response->setHeader('Content-disposition', 'attachment; filename='. $fileName .'.csv');

        $response->sendHeaders();
        $response->clearHeaders();

        echo $billableCalls;
    }
}
