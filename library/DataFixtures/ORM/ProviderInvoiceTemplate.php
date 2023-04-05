<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\InvoiceTemplate\InvoiceTemplate;

class ProviderInvoiceTemplate extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(InvoiceTemplate::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $item1 = $this->createEntityInstance(InvoiceTemplate::class);
        (function () use ($fixture) {
            $this->setName("Default");
            $this->setDescription("Something");
            $this->setTemplate("Template");
            $this->setTemplateHeader("Template header");
            $this->setTemplateFooter("Template footer");
            $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
        })->call($item1);

        $this->addReference('_reference_ProviderInvoiceTemplate1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstance(InvoiceTemplate::class);
        (function () use ($fixture) {
            $this->setName("Generic");
            $this->setDescription("Generic invoice template");

            $this->setTemplate(
                <<<HTML
                <div>
                    <div class="clientData">
                        <h2>Cliente</h2>
                        <p>{{company.name}}</p>
                        <p>{{company.postalAddress}}</p>
                        <p>{{company.postalCode}} {{company.town}}, {{company.province}} </p>
                        <p>NIF / CIF: {{company.nif}}</p>
                    </div>
                    <div class="invoiceData">
                        <p class="bold">Nº de factura</p>
                        <p>{{invoice.number}}</p>
                        <p class="bold">Periodo de facturación</p>
                        <p>{{invoice.inDate}} - {{invoice.outDate}}</p>
                    </div>
                </div>
                HTML
            );
            $this->setTemplateHeader(
                <<<HTML
                <div>
                    <p class="bold">{{brand.name}}</p>
                    <p class="bold">{{brand.invoice.postalAddress}}, {{brand.invoice.postalCode}} {{brand.invoice.town}}, {{brand.invoice.province}} </p>
                    <p>NIF / CIF: {{brand.invoice.nif}}</p>
                </div>
                HTML
            );
            $this->setTemplateFooter(
                <<<HTML
                <body>
                    <p id="registryData">
                        #{{brand.invoice.registryData}}
                    </p>
                    <div id="footer">
                      <p>
                        <span id="page"></span>
                        / <span id="topage"></span>
                      </p>
                    </div>
                    <script>
                      var vars = {};
                      var query_strings_from_url = document.location.search.substring(1).split('&');
                      for (var query_string in query_strings_from_url) {
                          if (query_strings_from_url.hasOwnProperty(query_string)) {
                              var temp_var = query_strings_from_url[query_string].split('=', 2);
                              vars[temp_var[0]] = decodeURI(temp_var[1]);
                          }
                      }
                      document.getElementById('page').innerHTML = vars.page;
                      document.getElementById('topage').innerHTML = vars.topage;
                    </script>
                </body>
                HTML
            );
        })->call($item2);

        $this->addReference('_reference_ProviderInvoiceTemplate2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderBrand::class
        );
    }
}
