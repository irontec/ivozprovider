<?php

use IvozProvider\Utils\TokenHelper;

class KlearCustomRtController extends Zend_Controller_Action
{
    public function init()
    {
        /* Initialize action controller here */
        $this->_helper->ContextSwitch()
            ->addActionContext('trunks', 'json')
            ->addActionContext('users', 'json')
            ->initContext('json');


        if ((!$this->_mainRouter = $this->getRequest()->getParam("mainRouter")) ||
            (!is_object($this->_mainRouter))) {
            throw new Zend_Exception(
                'Restricted access',
                \Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION
            );
        }

        $this->_mainRouter = $this->getRequest()->getParam("mainRouter");
        $this->_item = $this->_mainRouter->getCurrentItem();
    }

    public function trunksAction()
    {
        $auth = Zend_Auth::getInstance();
        if (!$auth->hasIdentity()) {
            throw new Klear_Exception_Default("Session expired");
        }
        $user = $auth->getIdentity();

        if ($user->isTokenExpired()) {
            TokenHelper::renewToken(
                $user,
                $user->brandId
            );
        }

        $data = array();
        $data['screen'] = $this->_mainRouter->getCurrentItemName();
        $data['title'] = $this->_item->getTitle();
        $data['secret'] = $user->token;

        $config = $this->_mainRouter->getCurrentItem()->getConfig();
        $forcedValues = $config->getProperty("forcedValues");

        if ($forcedValues) {
            $forcedValues = $forcedValues->toArray();
            $criteria = $forcedValues;
            $template = '/template/klearCustomRtCallBrandList.tmpl.html';
            $templateIden = 'RtCallBrandList';
        } else {
            $criteria = [];
            $template = '/template/klearCustomRtCallList.tmpl.html';
            $templateIden = 'RtCallList';
        }

        $criteria = $this->appendFilters(
            $criteria
        );

        $data['channel'] = [
            'trunks' => $criteria
        ];
        $data["template"] = $templateIden;
        $data['translations'] = $this->getTransalations();
        $data["columns"] = $this->getColumns(
            !isset($forcedValues['b'])
        );

        $templates = [
            $templateIden => $template
        ];

        $this->_dispatchResponse(
            $templates,
            $data
        );
    }

    /**
     * @return int|null
     */
    private function getBrandId()
    {
        $config = $this->_mainRouter->getCurrentItem()->getConfig();
        $forcedValues = $config->getProperty("forcedValues");
        if ($forcedValues) {
            $forcedValues = $forcedValues->toArray();
        }

        if (isset($forcedValues['b'])) {
            return (int) $forcedValues['b'];
        }

        $searchFields = $this->cleanSearchFields(
            $this->_request->getPost("searchFields", [])
        );
        if (isset($searchFields['b'])) {
            $value = end($searchFields['b']);

            return (int) preg_replace(
                '/[^0-9]+/',
                '',
                $value
            );
        }

        return null;
    }

    public function usersAction()
    {
        $auth = Zend_Auth::getInstance();
        if (!$auth->hasIdentity()) {
            throw new Klear_Exception_Default("Session expired");
        }
        $user = $auth->getIdentity();

        if ($user->isTokenExpired()) {
            TokenHelper::renewToken(
                $user,
                $user->brandId
            );
        }

        $data = array();
        $data['screen'] = $this->_mainRouter->getCurrentItemName();
        $data['title'] = $this->_item->getTitle();
        $data['secret'] = $user->token;

        $config = $this->_mainRouter->getCurrentItem()->getConfig();
        $criteria = $config->getProperty("forcedValues");

        if ($criteria) {
            $criteria = $criteria->toArray();
            $template = isset($criteria['c'])
                ? '/template/klearCustomRtCallClientList.tmpl.html'
                : '/template/klearCustomRtCallBrandList.tmpl.html';
        } else {
            $criteria = [];
            $template = '/template/klearCustomRtCallList.tmpl.html';
        }

        $criteria = $this->appendFilters(
            $criteria
        );

        $data['channel'] = [
            'users' => $criteria
        ];

        $data['translations'] = $this->getTransalations();

        $templateIden = 'RtCallClientList';
        $data["template"] = $templateIden;

        $templates = [
            $templateIden => $template
        ];

        $this->_dispatchResponse(
            $templates,
            $data
        );
    }

    private function appendFilters(array $criteria)
    {
        $searchFields = $this->cleanSearchFields(
            $this->_request->getPost("searchFields", [])
        );

        if (isset($searchFields['dir'])) {
            $searchFields['c'] = $searchFields['c'] ?? ['c*'];
        }

        if (isset($searchFields['cr']) || isset($searchFields['dp'])) {
            $searchFields['c'] = $searchFields['c'] ?? ['c*'];
        }

        if (isset($searchFields['c'])) {
            $searchFields['b'] = $searchFields['b'] ?? ['b*'];
        }

        foreach ($searchFields as $field => $values) {
            $value = end($values);
            $key = preg_replace('/[^a-zA-Z]+/', '', $value);
            $val = preg_replace('/[^0-9\*]+/', '', $value);

            if (isset($criteria[$key]) && $criteria[$key] != '*') {
                continue;
            }

            $criteria[$key] = $val;
        }

        $keyOrder = [
            'b' => 0,
            'c' => 1,
            'cr' => 2,
            'dp' => 2
        ];

        uksort(
            $criteria,
            function ($k1, $k2) use ($keyOrder) {
                return $keyOrder[$k1] > $keyOrder[$k2];
            }
        );

        return $criteria;
    }

    private function _dispatchResponse(
        array $templates,
        $data
    ) {
        $jsonResponse = new Klear_Model_DispatchResponse();
        $jsonResponse->setModule('default');
        $jsonResponse->setPlugin('rt');

        $jsonResponse->addTemplate(
            '/template/filters.tmpl.html',
            "rt-filters"
        );
        foreach ($templates as $key => $val) {
            $jsonResponse->addTemplate($val, $key);
        }

        $jsonResponse->addJsFile("/js/plugins/jquery.rt.js");
        $jsonResponse->addJsFile(
            "/js/translation/jquery.klearmatrix.translation.js"
        );

        $jsonResponse->addCssFile("/css/klearCustomRtCallList.tmpl.css");

        $data['searchOps'] = $this->_request->getPost("searchOps");

        $searchFields = $this->cleanSearchFields(
            $this->_request->getPost("searchFields", [])
        );

        if (!empty($searchFields)) {
            $data['searchFields'] = $searchFields;
        }

        if (!empty($data['searchOps']) || !empty($data['searchFields'])) {
            $data["applySearchFilters"] = true;
        }

        $jsonResponse->setData($data);

        $jsonResponse->attachView($this->view);
    }

    private function getTransalations(): array
    {
        return [
            'checkDocumentation' => $this->_helper->translate(
                "Check documentation for this section"
            ),
            'listOf' => $this->_helper->translate('List of %s'),
            'activeCalls' => $this->_helper->translate('Active calls'),
            'total' => $this->_helper->translate('Total'),
            'calls' => $this->_helper->translate('Calls'),
            'duration' => $this->_helper->translate('Duration'),
            'brand' => $this->_helper->translate(array('Brand', 'Brands', 1)),
            'carrier' => $this->_helper->translate(array('Carrier', 'Carriers', 1)),
            'client' => $this->_helper->translate(array('Client', 'Clients', 1)),
            'caller' => $this->_helper->translate('Caller'),
            'callee' => $this->_helper->translate('Callee'),
            'connecting' => $this->_helper->translate('Connecting'),
            'loading' => $this->_helper->translate('Loading'),
            'noCalls' => $this->_helper->translate('No calls'),
            'owner' => $this->_helper->translate('Owner'),
            'party' => $this->_helper->translate('Party'),
            'min' => $this->_helper->translate('min'),
            'sec' => $this->_helper->translate('sec'),
            'filterFields' => $this->_helper->translate('Filter fields'),
        ];
    }

    private function getColumns(
        $brand = true,
        $client = true,
        $operator = true
    ) {
        $dataGateway = \Zend_Registry::get('data_gateway');
        $columns = [];

        $brandId = $this->getBrandId();
        if ($brand) {
            $brands = $dataGateway->runNamedQuery(
                \Ivoz\Provider\Domain\Model\Brand\Brand::class,
                'getNames',
                []
            );

            $brandValues = [];
            foreach ($brands as $id => $name) {
                $brandValues[] = [
                    'key' => 'b' . $id,
                    'item' => $name,
                ];
            }

            $columns[] = [
                'b',
                $this->_helper->translate(array('Brand', 'Brands', 1)),
                $brandValues
            ];
        }

        if ($client) {
            $clients = $dataGateway->runNamedQuery(
                \Ivoz\Provider\Domain\Model\Company\Company::class,
                'getNames',
                [$brandId]
            );

            $clientValues = [];
            foreach ($clients as $id => $name) {
                $clientValues[] = [
                    'key' => 'c' . $id,
                    'item' => $name,
                ];
            }

            $columns[] = [
                'c',
                $this->_helper->translate(array('Client', 'Clients', 1)),
                $clientValues
            ];
        }

        if ($operator) {
            $searchFields = $this->cleanSearchFields(
                $this->_request->getPost("searchFields", [])
            );

            $crFilter = isset($searchFields['cr']);
            $dpFilter = isset($searchFields['dp']);
            $dirFilter = isset($searchFields['dir']);

            if (!$crFilter && !$dpFilter) {
                $columns[] = [
                    'dir',
                    $this->_helper->translate('Direction'),
                    [
                        [
                            'key' => 'cr*',
                            'item' => $this->_helper->translate('Outbound')
                        ],
                        [
                            'key' => 'dp*',
                            'item' => $this->_helper->translate('Inbound')
                        ],
                    ]
                ];
            }

            if (!$dpFilter && (!$dirFilter || $searchFields['dir'][0] == 'cr*')) {
                $carrierValues = [];
                $carriers = $dataGateway->runNamedQuery(
                    \Ivoz\Provider\Domain\Model\Carrier\Carrier::class,
                    'getNames',
                    [$brandId]
                );
                foreach ($carriers as $id => $name) {
                    $carrierValues[] = [
                        'key' => 'cr' . $id,
                        'item' => $name,
                    ];
                }
                $columns[] = [
                    'cr',
                    $this->_helper->translate(array('Carrier', 'Carriers', 1)),
                    $carrierValues
                ];
            }

            if (!$crFilter && (!$dirFilter || $searchFields['dir'][0] == 'dp*')) {
                $ddiProviderValues = [];
                $ddiProviders = $dataGateway->runNamedQuery(
                    \Ivoz\Provider\Domain\Model\DdiProvider\DdiProvider::class,
                    'getNames',
                    [$brandId]
                );
                foreach ($ddiProviders as $id => $name) {
                    $ddiProviderValues[] = [
                        'key' => 'dp' . $id,
                        'item' => $name,
                    ];
                }
                $columns[] = [
                    'dp',
                    $this->_helper->translate(array('Ddi Provider', 'Ddi Providers', 1)),
                    $ddiProviderValues
                ];
            }
        }

        $response = [];
        foreach ($columns as $column) {
            list($id, $name, $values) = $column;
            $response[$id] = [
                'id' => $id,
                'name' => $name,
                'type' => 'select',
                'searchable' => true,
                'sortable' => false,
                'config' => ['values' => $values],
                'attributes' => null,
                'properties' => [
                    'required' => null,
                    'pattern' => null,
                    'placeholder' => null,
                    'nullIfEmpty' => null,
                    'maxLength' => null,
                    'expandable' => null,
                    'showSize' => null,
                    'defaultValue' => null,
                    'prefix' => '',
                    'sufix' => '',
                ],
            ];
        }

        return $response;
    }

    private function cleanSearchFields(array $searchFields): array
    {
        if (isset($searchFields['cr'])) {
            unset($searchFields['dp']);
        } elseif (isset($searchFields['cr'])) {
            unset($searchFields['cr']);
        }

        foreach ($searchFields as $k => $v) {
            $searchFields[$k] = [end($v)];
        }

        return $searchFields;
    }
}
