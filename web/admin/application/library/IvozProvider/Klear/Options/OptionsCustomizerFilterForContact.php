<?php

class IvozProvider_Klear_Options_OptionsCustomizerFilterForContact implements \KlearMatrix_Model_Interfaces_ParentOptionCustomizer
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
        $show = true;

        $optionName = $this->_option->getName();
        $user = $parentModel->getUser();

        if ($optionName == 'contactsDel_dialog' && $user) {
            $show = false;
        }

        if ($optionName === 'contactsEdit_screen' && $user) {
            $show = false;
        }

        if ($optionName === 'contactsEditLimited_screen' && !$user) {
            $show = false;
        }

        if (!$show) {
            $response = new \KlearMatrix_Model_ParentOptionCustomizer_Response();
            $response
                ->setParentWrapper($this->_resultWrapper)
                ->setParentCssClass($this->_cssClass);

            return $response;
        }

        return null;
    }
}
