<?php

namespace Service\InvoiceTemplate;

use Handlebars\Handlebars;
use Ivoz\Provider\Domain\Model\InvoiceTemplate\InvoiceTemplate;
use Ivoz\Provider\Domain\Model\InvoiceTemplate\InvoiceTemplateRepository;

class InvoiceTemplateGenerator
{
    public function __construct(
        private InvoiceTemplateRepository $invoiceTemplateRepository
    ) {
    }

    public function execute(int $invoiceTemplateId): ?string
    {
        /** @var ?InvoiceTemplate $invoiceTemplate */
        $invoiceTemplate = $this
            ->invoiceTemplateRepository
            ->find($invoiceTemplateId);

        if (is_null($invoiceTemplate)) {
            return null;
        }

        $templateEngine = new Handlebars();
        $variables = $this->getSampleData();
        $header = $templateEngine->render(
            (string) $invoiceTemplate->getTemplateHeader(),
            $variables
        );
        $body = $templateEngine->render(
            $invoiceTemplate->getTemplate(),
            $variables
        );
        $footer = $templateEngine->render(
            (string) $invoiceTemplate->getTemplateFooter(),
            $variables
        );

        return $header . $body . $footer;
    }

    /**
     * @return array<array-key, mixed>
     */
    private function getSampleData(): array
    {
        return array(
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
                array(
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
                array(
                    'name' => 'IRONTEC Internet y Sistemas sobre GNU/Linux S.L.',
                    'nif' => 'B-95274890',
                    'postalAddress' => ' Uribitarte 6, 2º',
                    'postalCode' => '48001',
                    'town' => 'Bilbao',
                    'province' => 'Bizkaia'
                ),
            'brand' =>
                array(
                    'name' => 'Ivoz Provider',
                    'nif' => 'B-95274890',
                    'postalAddress' => ' Uribitarte 6, 2º',
                    'postalCode' => '48001',
                    'town' => 'Bilbao',
                    'province' => 'Bizkaia',
                    'registryData' => 'Multitenant solution for VoIP telephony providers'
                ),
            'callData' =>
                array(
                    'callSumary' =>
                        array(
                            array(
                                'type' => 'Spain',
                                'numberOfCalls' => 7,
                                'totalCallsDuration' => 227,
                                'totalPrice' => 2.6300000000000003,
                                'totalCallsDurationFormatted' => '00:03:47',
                                'currency' => '$'
                            ),
                            array(
                                'type' => 'United Kingdom',
                                'numberOfCalls' => 13,
                                'totalCallsDuration' => 81,
                                'totalPrice' => 2.9399999999999999,
                                'totalCallsDurationFormatted' => '00:01:21',
                                'currency' => '$'
                            ),
                        ),
                    'callsPerType' =>
                        array(
                            array(
                                'items' => array(
                                    0 =>
                                        array(
                                            'id' => 2418,
                                            'calldate' => '07/05/2017 18:28:21',
                                            'dst' => '944048182',
                                            'price' => '0.05',
                                            'currency' => '$',
                                            'durationFormatted' => '00:00:03',
                                            'targetPattern' =>
                                                array(
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
                                                array(
                                                    'name' => 'Plan estándar 2017',
                                                ),
                                        ),
                                    1 =>
                                        array(
                                            'id' => 2442,
                                            'calldate' => '08/05/2017 8:21:20',
                                            'dst' => '944048182',
                                            'price' => '1.05',
                                            'currency' => '$',
                                            'durationFormatted' => '00:01:34',
                                            'targetPattern' =>
                                                array(
                                                    'id' => 8,
                                                    'name' => 'Spain',
                                                ),
                                            'pricingPlan' =>
                                                array(
                                                    'name' => 'Plan estándar 2017',
                                                ),
                                        ),
                                    2 =>
                                        array(
                                            'id' => 2467,
                                            'calldate' => '11/05/2017 9:34:05',
                                            'dst' => '944048182',
                                            'price' => '0.09',
                                            'currency' => '$',
                                            'durationFormatted' => '00:00:06',
                                            'targetPattern' =>
                                                array(
                                                    'name' => 'Spain',
                                                ),
                                            'pricingPlan' =>
                                                array(
                                                    'name' => 'Plan estándar 2017',
                                                ),
                                        ),
                                    3 =>
                                        array(
                                            'id' => 2475,
                                            'calldate' => '11/05/2017 9:37:15',
                                            'dst' => '944048182',
                                            'price' => '0.50',
                                            'currency' => '$',
                                            'durationFormatted' => '00:00:44',
                                            'targetPattern' =>
                                                array(
                                                    'name' => 'Spain',
                                                ),
                                            'pricingPlan' =>
                                                array(
                                                    'name' => 'Plan estándar 2017',
                                                ),
                                        ),
                                    4 =>
                                        array(
                                            'id' => 2482,
                                            'calldate' => '11/05/2017 9:39:58',
                                            'dst' => '944048182',
                                            'price' => '0.29',
                                            'currency' => '$',
                                            'durationFormatted' => '00:00:25',
                                            'targetPattern' =>
                                                array(
                                                    'name' => 'Spain',
                                                ),
                                            'pricingPlan' =>
                                                array(
                                                    'name' => 'Plan estándar 2017',
                                                ),
                                        ),
                                    5 =>
                                        array(
                                            'id' => 2484,
                                            'calldate' => '11/05/2017 9:40:26',
                                            'dst' => '944048182',
                                            'price' => '0.36',
                                            'currency' => '$',
                                            'durationFormatted' => '00:00:31',
                                            'targetPattern' =>
                                                array(
                                                    'name' => 'Spain',
                                                ),
                                            'pricingPlan' =>
                                                array(
                                                    'name' => 'Plan estándar 2017',
                                                ),
                                        ),
                                )
                            ),
                            array(
                                'items' => array(
                                    0 =>
                                        array(
                                            'id' => 2464,
                                            'calldate' => '11/05/2017 9:33:29',
                                            'dst' => '44676105642',
                                            'price' => '0.29',
                                            'currency' => '$',
                                            'durationFormatted' => '00:00:08',
                                            'targetPattern' =>
                                                array(
                                                    'name' => 'United Kingdom',
                                                ),
                                            'pricingPlan' =>
                                                array(
                                                    'name' => 'Europa 2017',
                                                ),
                                        ),
                                    1 =>
                                        array(
                                            'id' => 2468,
                                            'calldate' => '11/05/2017 9:34:41',
                                            'dst' => '44620114553',
                                            'price' => '0.08',
                                            'currency' => '$',
                                            'durationFormatted' => '00:00:02',
                                            'targetPattern' =>
                                                array(
                                                    'name' => 'United Kingdom',
                                                ),
                                            'pricingPlan' =>
                                                array(
                                                    'name' => 'Europa 2017',
                                                ),
                                        ),
                                    2 =>
                                        array(
                                            'id' => 2474,
                                            'calldate' => '11/05/2017 9:36:24',
                                            'dst' => '44620114553',
                                            'price' => '0.74',
                                            'currency' => '$',
                                            'durationFormatted' => '00:00:21',
                                            'targetPattern' =>
                                                array(
                                                    'name' => 'United Kingdom',
                                                ),
                                            'pricingPlan' =>
                                                array(
                                                    'name' => 'Europa 2017',
                                                ),
                                        ),
                                    3 =>
                                        array(
                                            'id' => 2476,
                                            'calldate' => '11/05/2017 9:37:57',
                                            'dst' => '44620114553',
                                            'price' => '0.18',
                                            'currency' => '$',
                                            'durationFormatted' => '00:00:05',
                                            'targetPattern' =>
                                                array(
                                                    'name' => 'United Kingdom',
                                                ),
                                            'pricingPlan' =>
                                                array(
                                                    'name' => 'Europa 2017',
                                                ),
                                        ),
                                    4 =>
                                        array(
                                            'id' => 2479,
                                            'calldate' => '11/05/2017 9:39:13',
                                            'dst' => '44620114553',
                                            'price' => '0.08',
                                            'currency' => '$',
                                            'durationFormatted' => '00:00:02',
                                            'targetPattern' =>
                                                array(
                                                    'id' => 1,
                                                    'name' => 'United Kingdom',
                                                ),
                                            'pricingPlan' =>
                                                array(
                                                    'name' => 'Europa 2017',
                                                ),
                                        ),
                                    5 =>
                                        array(
                                            'id' => 2483,
                                            'calldate' => '11/05/2017 9:39:44',
                                            'dst' => '44676105642',
                                            'price' => '0.15',
                                            'currency' => '$',
                                            'durationFormatted' => '00:00:04',
                                            'targetPattern' =>
                                                array(
                                                    'name' => 'United Kingdom',
                                                ),
                                            'pricingPlan' =>
                                                array(
                                                    'name' => 'Europa 2017',
                                                ),
                                        )
                                )
                            ),
                        ),
                    'callSumaryTotals' =>
                        array(
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
                            'calls' => array(
                                0 => array(
                                    'calldate' => '11/05/2017 9:33:29',
                                    'caller' => '49302540070',
                                    'dst' => '1008',
                                    'price' => '0.29',
                                    'currency' => '$',
                                    'durationFormatted' => '00:00:08',
                                    'targetPattern' =>
                                        array(
                                            'name' => 'Alemania'
                                        )
                                ),
                            )
                        ),
                ),
            'totals' =>
                array(
                    'totalPrice' => 5.5700000000000003,
                    'totalTaxes' => '1.12',
                    'totalWithTaxes' => '6.69'
                )
        );
    }
}
