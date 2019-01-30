<?php

class IvozProvider_Klear_Options_OptionsCustomizer implements \KlearMatrix_Model_Interfaces_ParentOptionCustomizer
{
    /**
     * @var KlearMatrix_Model_RouteDispatcher
     */
    protected $_mainRouter = null;

    /**
     * @var array
     */
    protected $_mainRouterOriginalParams = null;

    /**
     * @var KlearMatrix_Model_AbstractOption
     */
    protected $_option = null;

    protected $_resultWrapper = 'div';
    protected $_cssClass = 'hidden';
    protected $_parentModel;


    public function __construct(\Zend_Config $configuration)
    {
        $front = \Zend_Controller_Front::getInstance();
        $this->_mainRouter = $front->getRequest()->getUserParam("mainRouter");
        $this->_mainRouterOriginalParams = $this->_mainRouter->getParams();
    }

    public function setOption(\KlearMatrix_Model_Option_Abstract $option)
    {
        $this->_option = $option;
    }

    /**
     * @return KlearMatrix_Model_ParentOptionCustomizer_Response
     */
    public function customize($parentModel)
    {

        $this->_parentModel = $parentModel;
        $show = true;
        switch ($this->_option->getName()) {
            case "emulateBrand_dialog":
                $show = $this->_checkEmulation("brand");
                break;
            case "emulateCompany_dialog":
                $show = $this->_checkEmulation("company");
                break;
            case 'invoicesView_screen':
                $show = $parentModel->getStatus() === 'created';
                break;
            case "pricingPlansEdit_screen":
                $show = !$this->_pricingPlanHasStarted();
                break;
            case "pricingPlansDel_dialog":
                $show = !$this->_pricingPlanHasStarted();
                break;
            case "pricingPlansView_screen":
                $show = false;
                break;
            case "pricingPlansRelTargetPatternsList_screen":
                $show = !$this->_pricingPlanHasStarted();
                break;
            case "pricingPlansRelTargetPatternsListView_screen":
                $show = $this->_pricingPlanHasStarted();
                break;
            case "mediaRelaySetsEdit_screen":
            case "mediaRelaySetsDel_dialog":
                $show = $this->_isRemovable();
                break;
            case "domainsEdit_screen":
            case "domainsDel_dialog":
                $show = $this->_isEditable();
                break;
            case "domainsView_screen":
                $show = !$this->_isEditable();
                break;
            case "transformationRuleSetsEdit_screen":
            case "transformationRuleSetsDel_dialog":
            case "transformationRulesCallerInList_screen":
            case "transformationRulesCalleeInList_screen":
            case "transformationRulesCallerOutList_screen":
            case "transformationRulesCalleeOutList_screen":
                $show = $this->_isBrandData();
                break;
            case "transformationRuleSetsView_screen":
            case "transformationRulesCallerInView_screen":
            case "transformationRulesCalleeInView_screen":
            case "transformationRulesCallerOutView_screen":
            case "transformationRulesCalleeOutView_screen":
                $show = !$this->_isBrandData();
                break;
            case "matchListsEdit_screen":
            case "matchListsDel_dialog":
            case "matchListPatternsList_screen":
                $show = $this->_isCompanyData();
                break;
            case "matchListPatternsView_screen":
                $show = !$this->_isCompanyData();
                break;
            case "genericMatchListsEdit_screen":
            case "genericMatchListPatternsList_screen":
            case "genericMatchListsDel_dialog":
                $show = $this->_isBrandData();
                break;
            case "ratingProfilesList_screen":
            case "addToBalance_dialog":
            case "balanceNotificationList_screen":
            case "balanceMovementsList_screen":
                $show = $this->_parentModel->getCalculateCost();
                break;
            default:
                throw new Klear_Exception_Default("Unsupported dialog " . $this->_option->getName());
                break;
        }

        if ($show) {
            return null;
        } else {
            /* Para no mostrarlo iniciamos una respuesta vacía */
            $response = new \KlearMatrix_Model_ParentOptionCustomizer_Response();
            $response->setParentWrapper($this->_resultWrapper)
                ->setParentCssClass($this->_cssClass);

            return $response;
        }
    }

    protected function _isRemovable()
    {
        $name = $this->_parentModel->getName();
        return $name != 'Default';
    }

    protected function _isEditable()
    {
        $scope  = $this->_parentModel->getScope();
        $domain = $this->_parentModel->getDomain();

        $isEditable = ( $scope == 'global' &&
                        $domain != 'users.ivozprovider.local' &&
                        $domain != 'trunks.ivozprovider.local');

        return $isEditable;
    }

    protected function _isBrandData()
    {
        $brandId = $this->_parentModel->getBrandId();

        return $brandId != null;
    }

    protected function _isCompanyData()
    {
        $companyId = $this->_parentModel->getCompanyId();

        return $companyId != null;
    }


    protected function _checkEmulation($type)
    {
        $auth = Zend_Auth::getInstance();
        if (!$auth->hasIdentity()) {
            //TODO Exceptionante
            throw new Klear_Exception_Default("No ".$type." emulated");
        }
        $loggedUser = $auth->getIdentity();

        $propperty = $type."Id";
        $currentModelId = $loggedUser->{$propperty};
        $parentModelId = $this->_parentModel->getId();

        return $currentModelId != $parentModelId;
    }

    protected function _pricingPlanHasStarted()
    {

//         $validFrom = $this->_parentModel->getValidFrom(true);
//         $now = new  \Zend_Date();
//         $now->setTimezone("UTC");

//         if ($now->compare($validFrom) == -1) {
//             return false;
//         }
        return true;
    }
}
