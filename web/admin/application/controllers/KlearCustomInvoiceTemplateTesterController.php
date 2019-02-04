<?php

use Knp\Snappy\Pdf;
use Handlebars\Handlebars;
use \Ivoz\Provider\Domain\Model\InvoiceTemplate\InvoiceTemplate;

class KlearCustomInvoiceTemplateTesterController extends Zend_Controller_Action
{
    protected $_mainRouter;

    protected $_pk ;

    public function init()
    {
        // Nos aseguramos que este controlador se ejecuta sólamente desde klear!
        if ((!$this->_mainRouter = $this->getRequest()->getUserParam("mainRouter"))
         ||    (!is_object($this->_mainRouter)) ) {
            throw new Zend_Exception('', Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION);
        }

        //Inicia el contenido en Json
        $this->_helper->ContextSwitch()
        ->addActionContext('index', 'json')
        ->initContext('json');

        $this->_mainRouter = $this->getRequest()->getUserParam("mainRouter");
        $this->_item = $this->_mainRouter->getCurrentItem();

        $this->_helper->layout->disableLayout();
    }

    public function indexAction()
    {

        $this->_pk = $this->getRequest()->getParam("pk");

        if ($this->getRequest()->getParam("ok")) {
            $data = $this->_getOkData();
        } else {
            $data = $this->_getDefaultData();
        }
        $this->_dispatchResponse($data);
    }

    protected function _getDefaultData()
    {
        /** @var \Ivoz\Core\Application\Service\DataGateway $dataGateway */
        $dataGateway = \Zend_Registry::get('data_gateway');
        $templateModel = $dataGateway->find(InvoiceTemplate::class, $this->_pk);

        $variables = $this->_getSampleData();
        $templateEngine = new Handlebars;
        $header = $templateEngine->render($templateModel->getTemplateHeader(), $variables);
        $body = $templateEngine->render($templateModel->getTemplate(), $variables);
        $footer = $templateEngine->render($templateModel->getTemplateFooter(), $variables);

        $architecture = (php_uname("m") === 'x86_64') ? 'amd64' : 'i386';

        $snappy = new Pdf('/opt/irontec/ivozprovider/library/vendor/bin/wkhtmltopdf-' . $architecture);
        $snappy->setOption('header-html', $header);
        $snappy->setOption('header-spacing', 3);
        $snappy->setOption('footer-html', $footer);
        $snappy->setOption('footer-spacing', 3);
        $content = $snappy->getOutputFromHtml($body);
        $snappy->removeTemporaryFiles();

        $templateFolder = "/invoice-template-tester/";
        $targetFolder = APPLICATION_PATH . "/../public" . $templateFolder;

        if (!file_exists($targetFolder)) {
            mkdir($targetFolder, 0777, true);
        }

        $tempFilePath = $targetFolder . $this->_pk .".pdf";
        file_put_contents($tempFilePath, $content);

        $tempFileLink = $this->view->serverUrl() . $templateFolder . $this->_pk . ".pdf";
        $message = "<h2>Click <a href='".$tempFileLink."' target='_blank'> <span class=\"ui-silk inline ui-silk-page-white-acrobat\"></span>here</a> to view the result</p>";

        $data = array(
            "title" => $this->_helper->translate("Invoice template tester"),
            "message" => $message,
            "options" => array('width'=>'300px'),
            "buttons" => array(
              $this->_helper->translate("Close") => array(
                  "recall" => false,
                  "reloadParent" => false
              )
          )
        );
        return $data;
    }

    protected function _getOkData()
    {
        $message = "This is OK dialog message";
        $data = array(
            "title" => "OK Dialog Title",
            "message" => $message,
            "options" => array('width'=>'300px'),
            "buttons" => array(
                $this->_helper->translate("Accept") => array(
                    "recall" => false,
                    "reloadParent" => true
                )
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

    protected function _getSampleData()
    {
        return array (
            'fixedCosts' => array(
                array(
                    "quantity" => 1,
                    "name" => "Business Plan",
                    "description" => "plan description",
                    "cost" => 10.3300,
                    "subTotal" => 10.3300,
                    "currency" => "$"
                ),
            ),
            'fixedCostsTotals' => 10.3300,
            'invoice' =>
            array (
                'number' => '667',
                'inDate' => '01/05/2017',
                'outDate' => '16/05/2017',
                'total' => 5.5700000000000003,
                'taxRate' => 20,
                'totalWithTax' => 6.6900000000000004,
                'invoiceDate' => '24/06/2017',
                'currency' => '$',
            ),
            'company' =>
            array (
                'name' => 'IRONTEC Internet y Sistemas sobre GNU/Linux S.L.',
                'nif' => 'B-95274890',
                'postalAddress' => ' Uribitarte 6, 2º',
                'postalCode' => '48001',
                'town' => 'Bilbao',
                'province' => 'Bizkaia'
            ),
            'brand' =>
            array (
                'name' => 'Ivoz Provider',
                'nif' => 'B-95274890',
                'postalAddress' => ' Uribitarte 6, 2º',
                'postalCode' => '48001',
                'town' => 'Bilbao',
                'province' => 'Bizkaia',
                'registryData' => 'Multitenant solution for VoIP telephony providers'
            ),
            'callData' =>
            array (
                    'callSumary' =>
                    array (
                            array (
                                'type' => 'Spain',
                                'numberOfCalls' => 7,
                                'totalCallsDuration' => 227,
                                'totalPrice' => 2.6300000000000003,
                                'totalCallsDurationFormatted' => '00:03:47',
                                'currency' => '$'
                            ),
                            array (
                                'type' => 'United Kingdom',
                                'numberOfCalls' => 13,
                                'totalCallsDuration' => 81,
                                'totalPrice' => 2.9399999999999999,
                                'totalCallsDurationFormatted' => '00:01:21',
                                'currency' => '$'
                            ),
                    ),
                    'callsPerType' =>
                    array (
                        array (
                            'items' => array(
                                0 =>
                                array (
                                    'id' => 2418,
                                    'calldate' => '07/05/2017 18:28:21',
                                    'dst' => '944048182',
                                    'price' => '0.05',
                                    'currency' => '$',
                                    'durationFormatted' => '00:00:03',
                                    'targetPattern' =>
                                    array (
                                        'id' => 8,
                                        'name_en' => 'Local fixed',
                                        'name_es' => 'Spain',
                                        'description_en' => '',
                                        'description_es' => '',
                                        'regExp' => '/^0?94[0-9]{7}$/',

                                        'name' => 'Spain',
                                        'description' => '',
                                    ),
                                    'pricingPlan' =>
                                    array (
                                        'name' => 'Plan estándar 2017',
                                    ),
                                ),
                                1 =>
                                array (
                                    'id' => 2442,
                                    'calldate' => '08/05/2017 8:21:20',
                                    'dst' => '944048182',
                                    'price' => '1.05',
                                    'currency' => '$',
                                    'durationFormatted' => '00:01:34',
                                    'targetPattern' =>
                                    array (
                                            'id' => 8,
                                            'name' => 'Spain',
                                    ),
                                    'pricingPlan' =>
                                    array (
                                            'name' => 'Plan estándar 2017',
                                    ),
                                ),
                                2 =>
                                array (
                                    'id' => 2467,
                                    'calldate' => '11/05/2017 9:34:05',
                                    'dst' => '944048182',
                                    'price' => '0.09',
                                    'currency' => '$',
                                    'durationFormatted' => '00:00:06',
                                    'targetPattern' =>
                                    array (
                                            'name' => 'Spain',
                                    ),
                                    'pricingPlan' =>
                                    array (
                                            'name' => 'Plan estándar 2017',
                                    ),
                                ),
                                3 =>
                                array (
                                    'id' => 2475,
                                    'calldate' => '11/05/2017 9:37:15',
                                    'dst' => '944048182',
                                    'price' => '0.50',
                                    'currency' => '$',
                                    'durationFormatted' => '00:00:44',
                                    'targetPattern' =>
                                    array (
                                            'name' => 'Spain',
                                    ),
                                    'pricingPlan' =>
                                    array (
                                            'name' => 'Plan estándar 2017',
                                    ),
                                ),
                                4 =>
                                array (
                                    'id' => 2482,
                                    'calldate' => '11/05/2017 9:39:58',
                                    'dst' => '944048182',
                                    'price' => '0.29',
                                    'currency' => '$',
                                    'durationFormatted' => '00:00:25',
                                    'targetPattern' =>
                                    array (
                                            'name' => 'Spain',
                                    ),
                                    'pricingPlan' =>
                                    array (
                                            'name' => 'Plan estándar 2017',
                                    ),
                                ),
                                5 =>
                                array (
                                    'id' => 2484,
                                    'calldate' => '11/05/2017 9:40:26',
                                    'dst' => '944048182',
                                    'price' => '0.36',
                                    'currency' => '$',
                                    'durationFormatted' => '00:00:31',
                                    'targetPattern' =>
                                    array (
                                            'name' => 'Spain',
                                    ),
                                    'pricingPlan' =>
                                    array (
                                            'name' => 'Plan estándar 2017',
                                    ),
                                ),
                            )
                        ),
                        array (
                            'items' => array(
                                0 =>
                                array (
                                    'id' => 2464,
                                    'calldate' => '11/05/2017 9:33:29',
                                    'dst' => '44676105642',
                                    'price' => '0.29',
                                    'currency' => '$',
                                    'durationFormatted' => '00:00:08',
                                    'targetPattern' =>
                                    array (
                                            'name' => 'United Kingdom',
                                    ),
                                    'pricingPlan' =>
                                    array (
                                            'name' => 'Europa 2017',
                                    ),
                                ),
                                1 =>
                                array (
                                    'id' => 2468,
                                    'calldate' => '11/05/2017 9:34:41',
                                    'dst' => '44620114553',
                                    'price' => '0.08',
                                    'currency' => '$',
                                    'durationFormatted' => '00:00:02',
                                    'targetPattern' =>
                                    array (
                                            'name' => 'United Kingdom',
                                    ),
                                    'pricingPlan' =>
                                    array (
                                            'name' => 'Europa 2017',
                                    ),
                                ),
                                2 =>
                                array (
                                    'id' => 2474,
                                    'calldate' => '11/05/2017 9:36:24',
                                    'dst' => '44620114553',
                                    'price' => '0.74',
                                    'currency' => '$',
                                    'durationFormatted' => '00:00:21',
                                    'targetPattern' =>
                                    array (
                                        'name' => 'United Kingdom',
                                    ),
                                    'pricingPlan' =>
                                    array (
                                            'name' => 'Europa 2017',
                                    ),
                                ),
                                3 =>
                                array (
                                    'id' => 2476,
                                    'calldate' => '11/05/2017 9:37:57',
                                    'dst' => '44620114553',
                                    'price' => '0.18',
                                    'currency' => '$',
                                    'durationFormatted' => '00:00:05',
                                    'targetPattern' =>
                                    array (
                                            'name' => 'United Kingdom',
                                    ),
                                    'pricingPlan' =>
                                    array (
                                            'name' => 'Europa 2017',
                                    ),
                                ),
                                4 =>
                                array (
                                    'id' => 2479,
                                    'calldate' => '11/05/2017 9:39:13',
                                    'dst' => '44620114553',
                                    'price' => '0.08',
                                    'currency' => '$',
                                    'durationFormatted' => '00:00:02',
                                    'targetPattern' =>
                                    array (
                                            'id' => 1,
                                            'name' => 'United Kingdom',
                                    ),
                                    'pricingPlan' =>
                                    array (
                                            'name' => 'Europa 2017',
                                    ),
                                ),
                                5 =>
                                array (
                                    'id' => 2483,
                                    'calldate' => '11/05/2017 9:39:44',
                                    'dst' => '44676105642',
                                    'price' => '0.15',
                                    'currency' => '$',
                                    'durationFormatted' => '00:00:04',
                                    'targetPattern' =>
                                    array (
                                            'name' => 'United Kingdom',
                                    ),
                                    'pricingPlan' =>
                                    array (
                                            'name' => 'Europa 2017',
                                    ),
                                )
                            )
                        ),
                    ),
                    'callSumaryTotals' =>
                    array (
                        'numberOfCalls' => 20,
                        'totalCallsDuration' => 308,
                        'totalPrice' => 5.5700000000000003,
                        'totalCallsDurationFormatted' => '00:05:08',
                        'totalTaxes' => '1.12',
                        'totalWithTaxes' => '6.69',
                        'currency' => '$',
                    ),
                    'inboundCalls' =>
                    array(
                        'summary' => array(
                            'numberOfCalls' => 1,
                            'totalCallsDuration' => '4931',
                            'totalPrice' => '12.1002',
                            'totalCallsDurationFormatted' => '1:22:11',
                            'currency' => '$',
                        ),
                        'calls' => array (
                            0 => array (
                                'calldate' => '11/05/2017 9:33:29',
                                'caller' => '49302540070',
                                'dst' => '1008',
                                'price' => '0.29',
                                'currency' => '$',
                                'durationFormatted' => '00:00:08',
                                'targetPattern' =>
                                array (
                                    'name' => 'Alemania'
                                )
                            ),
                        )
                    ),
            ),
            'totals' =>
            array (
                'totalPrice' => 5.5700000000000003,
                'totalTaxes' => '1.12',
                'totalWithTaxes' => '6.69'
            )
        );
    }
}
