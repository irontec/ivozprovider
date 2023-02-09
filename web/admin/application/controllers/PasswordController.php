<?php

/**
 * @author Ivan Alonso <kaian@irontec.com>
 * @author Luis Felipe García <lfgarcia@irontec.com>
 *
 */
class PasswordController extends Zend_Controller_Action
{
    public function init()
    {
        /* Initialize action controller here */
        $this->_helper->layout->disableLayout();

        $this->_helper->ContextSwitch()
            ->addActionContext('generate', 'json')
            ->initContext('json');
    }

    /**
     * Draw an extra button for generating random passwords
     */
    public function generateAction()
    {
    }
}
