<?php

/**
 * @author jabi
 * Controlador "klearizado" (commands based), que devuelve información al script customMenu.js para la selección dinámica de brands/companys
 *     - Listado de Empresas
 *     - Modificación de objeto de autenticación (sustitución de empresa).
 */

use IvozProvider\Mapper\Sql\Companies;
use IvozProvider\Mapper\Sql\Brands;


class KlearCustomExtraAuthController extends Zend_Controller_Action
{
    protected $_user;

    public function init()
    {
        /* Initialize action controller here */

        $this->_helper->ContextSwitch()
                ->addActionContext('search', 'json')
                ->addActionContext('initial-data', 'json')
                ->addActionContext('set-data', 'json')
                ->addActionContext('emulate', 'json')
                ->initContext('json');

         if (!$this->_mainRouter = $this->getRequest()->getParam("mainRouter")
             || !is_object($this->_mainRouter)) {

                 throw New Zend_Exception($this->view->translate('Acceso restringido'), Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION);
         }

        $this->_mainRouter = $this->getRequest()->getParam("mainRouter");

        $this->_user = Zend_Auth::getInstance()->getIdentity();

//         if (!$this->_companyId) {

//             throw New Zend_Exception($this->view->translate('Acceso restringido'), Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION);
//         }
    }


    public function searchAction()
    {
        $type = $this->getRequest()->getParam("namespace");

        $mapper = false;
        $extraCondition = '';
        if ($type == 'brand') {
            if (!$this->_user->canSeeMain) {
                return $this->_noPermission();
            }
            $mapper = new Brands();
        }

        if ($type == 'company') {
            if (!$this->_user->canSeeBrand) {
                return $this->_noPermission();
            }
            $mapper = new Companies();
            if ($this->_user->isMainOperator && !is_null($this->_user->brandId)) {
                $extraCondition = ' and brandId='. $this->_user->brandId;
            } elseif ($this->_user->isBrandOperator) {
                $extraCondition = ' and brandId='. $this->_user->brandId;
            }
        }
        $term = '%' . $this->getRequest()->getParam("term") .'%';

        $items = $mapper->fetchList(array('namer;
    protected $_pk; like ? ' . $extraCondition, array($term)));

        $response = array();
        foreach ($items as $item) {
            $response[] = array('id'=>$item->getPrimaryKey(), 'label'=>$item->getName());
        }

        // Tenemos que forzar la salida para jquery-ui autocomplete
        echo json_encode($response);
        exit;


    }


    public function initialDataAction()
    {

        $type = $this->getRequest()->getParam("entityType");
        $html = '<form><div class="description ui-widget-content ui-corner-all"><span class="ui-icon ui-icon-flag"></span>';

        $options = array();
        $id = null;
        if ($type == 'brand') {
            if ($this->_user->canSeeMain) {
                $html .= '<p>' . $this->view->translate('Select the brand you want to emulate.') . '</p></div>';
                $title = $this->view->translate('Select Brand');
                $brandMapper = new Brands();
                $options = $brandMapper->fetchList(null, "name asc");
                if (!is_null($this->_user->brandId)) {
                    $id = $this->_user->brandId;
                }
            } else {
                return $this->_noPermission();
            }
        } elseif ($type == 'company') {
            if ($this->_user->canSeeBrand) {
                if (is_null($this->_user->brandId)) {
                    $html .= '<p>' . $this->view->translate('You have to emulate a brand to be able to emulate a company') . '</p></div>';
                } else {
                    $html .= '<p>' . $this->view->translate('Select the company you want to emulate') . '</p></div>';
                    $companiesMapper = new Companies();
                    $options = $companiesMapper->fetchList("brandId = '".$this->_user->brandId."'", "name asc");
                    if (!is_null($this->_user->companyId)) {
                        $id = $this->_user->companyId;
                    }
                }
                $title = $this->view->translate('Select Company');
            } else {
                return $this->_noPermission();
            }

        } else {
            return $this->_noPermission();
        }


        if ($type == 'brand' || ($this->_user->canSeeBrand && !is_null($this->_user->brandId))) {
            $html .= '<div class="entitySelectDiv">';
            $html .= '<select id="entitySelect" name="'.$type.'" data-type="'.$type.'" class="" data-size="4">';
            foreach ($options as $option) {
                $selected = "";
                if ($option->getPrimaryKey() == $id) {
                    $selected = "selected";
                }
                $html .= '<option value="'.$option->getPrimaryKey().'" '.$selected.'>'.$option->getName().'</option>';
            }
            $html .= "</select>";
            $html .= '</div>';
        }


        $html .= '<p class="submit"><input type="submit" value="'.$this->view->translate('Enter').'" /></p>';
        $html .= '</form>';
        $this->view->responseType = 'simple';
        $this->view->data = array(
                'body'=>$html,
                'title'=>$title
        );
    }

    public function setDataAction()
    {
        $this->view->responseType = 'simple';
        $this->view->data = $this->_getData();

    }

    protected function _getData()
    {
        $type = $this->getRequest()->getParam("entityType");

        $remoteId = "NONE!";

        if ($type == 'brand') {
            if ($this->_user->canSeeMain) {

                //TODO: verificar que existe y permisos
                $oldBrandId = $this->_user->brandId;
                $brandId = $this->getRequest()->getParam("remoteId");
                $remoteId = $brandId;
                $this->_user->setBrandId($brandId);
                if ($oldBrandId != $brandId) {
                    $this->_user->unsetCompany();
                }
            } else {
                return $this->_noPermission();
            }
        } elseif ($type == 'company') {
            if ($this->_user->canSeeBrand) {

                //TODO: verificar que existe y permisos
                $companyId = $this->getRequest()->getParam("remoteId");
                $remoteId = $companyId;
                $this->_user->setCompanyId($companyId);

            } else {
                return $this->_noPermission();
            }
        } else {
            return $this->_noPermission();
        }

        $auth = Zend_Auth::getInstance();
        $storage = $auth->getStorage();
        $result = $storage->write($this->_user);

        return array(
                'result'=>$result,
                'newIden' => $remoteId
                );
    }

    protected function _noPermission()
    {
        throw new Zend_Exception($this->view->translate('Acceso restringido'), Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION);
    }


    public function emulateAction()
    {
        $pk = $this->getRequest()->getParam("pk");
        $file = $this->getRequest()->getParam("file");
        switch ($file) {
            case "BrandsList":
                $type = "brand";
                $mapper = new \IvozProvider\Mapper\Sql\Brands();
                break;
            case "CompaniesList":
                $type = "company";
                $mapper = new \IvozProvider\Mapper\Sql\Companies();
                break;
            default:
                $this->_noPermission();
                break;
        }
        $model = $mapper->find($pk);

        if ($this->getRequest()->getParam("ok")) {
            $data = $this->_getEmulateOkData($type, $model);
        } else {
            $data = $this->_getEmulateDefaultData($type, $model);
        }
        $this->_dispatchResponse($data);
    }

    protected function _getEmulateDefaultData($type, $model)
    {
        $title = $this->view->translate('Emulate %s', $type);
        $message = $this->view->translate('Are you sure that you want to emulate the %s "%2s"?', $type, $model->getName());

        $data = array(
                "title" => $title,
                "message" => $message,
                "options" => array('width'=>'300px'),
                "buttons" => array(
                        _("Ok") => array(
                                "recall" => true,
                                "reloadParent" => false,
                                "params" => array(
                                        "ok" => true,
                                        "entityType" => $type,
                                        "remoteId" => $model->getPrimaryKey()
                                ),
                        ),
                        _("Cancel") => array(
                                "recall" => false,
                                "reloadParent" => false
                        )
                )
        );
        return $data;
    }

    protected function _getEmulateOkData($type, $model)
    {
        $this->_getData();
        $title = $this->view->translate('%s emulated', ucfirst($type));
        $messageLiteral = 'The "%s" %2s has been emulated. <p>Refreshing tabs.</p>';
        $messageLiteral .= '<script>$("#tabsList li").klearModule("reDispatch");$.klear.restart({}, false);</script>';
        $message = $this->view->translate($messageLiteral, $model->getName(), $type);
        $data = array(
                "title" => $title,
                "message" => $message,
                "options" => array('width'=>'300px'),
                "buttons" => array(
//                         _("Ok") => array(
//                                 "recall" => false,
//                                 "reloadParent" => true
//                         )
                )
        );

        return $data;
    }

    protected function _dispatchResponse($data)
    {
        //Inicia los plugins de KlearMatrix
        $jsonResponse = new Klear_Model_DispatchResponse();
        $jsonResponse->setModule('klearMatrix');
        $jsonResponse->setPlugin('klearMatrixGenericDialog');
        $jsonResponse->addJsFile("/js/plugins/jquery.klearmatrix.genericdialog.js");
        $jsonResponse->setData($data);
        $jsonResponse->attachView($this->view);
    }

}