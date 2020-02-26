Feature: Retrieve public entities
  In order to manage public entities
  as a super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the public entities json list
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "public_entities"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      [
          {
              "iden": "PublicEntitys",
              "id": 2,
              "name": {
                  "en": "PublicEntitys",
                  "es": "PublicEntitys",
                  "ca": "PublicEntitys",
                  "it": "PublicEntitys"
              }
          },
          {
              "iden": "BillableCalls",
              "id": 3,
              "name": {
                  "en": "BillableCalls",
                  "es": "BillableCalls",
                  "ca": "BillableCalls",
                  "it": "BillableCalls"
              }
          },
          {
              "iden": "Companies",
              "id": 12,
              "name": {
                  "en": "Companies",
                  "es": "Companies",
                  "ca": "Companies",
                  "it": "Companies"
              }
          },
          {
              "iden": "Countries",
              "id": 21,
              "name": {
                  "en": "Countries",
                  "es": "Countries",
                  "ca": "Countries",
                  "it": "Countries"
              }
          },
          {
              "iden": "Features",
              "id": 31,
              "name": {
                  "en": "Features",
                  "es": "Features",
                  "ca": "Features",
                  "it": "Features"
              }
          },
          {
              "iden": "Invoices",
              "id": 38,
              "name": {
                  "en": "Invoices",
                  "es": "Invoices",
                  "ca": "Invoices",
                  "it": "Invoices"
              }
          },
          {
              "iden": "Languages",
              "id": 42,
              "name": {
                  "en": "Languages",
                  "es": "Languages",
                  "ca": "Languages",
                  "it": "Languages"
              }
          },
          {
              "iden": "RatingPlanGroups",
              "id": 54,
              "name": {
                  "en": "RatingPlanGroups",
                  "es": "RatingPlanGroups",
                  "ca": "RatingPlanGroups",
                  "it": "RatingPlanGroups"
              }
          },
          {
              "iden": "Services",
              "id": 61,
              "name": {
                  "en": "Services",
                  "es": "Services",
                  "ca": "Services",
                  "it": "Services"
              }
          },
          {
              "iden": "TerminalModels",
              "id": 63,
              "name": {
                  "en": "TerminalModels",
                  "es": "TerminalModels",
                  "ca": "TerminalModels",
                  "it": "TerminalModels"
              }
          },
          {
              "iden": "Timezones",
              "id": 64,
              "name": {
                  "en": "Timezones",
                  "es": "Timezones",
                  "ca": "Timezones",
                  "it": "Timezones"
              }
          },
          {
              "iden": "_ActiveCalls",
              "id": 67,
              "name": {
                  "en": "_ActiveCalls",
                  "es": "_ActiveCalls",
                  "ca": "_ActiveCalls",
                  "it": "_ActiveCalls"
              }
          },
          {
              "iden": "Administrators",
              "id": 71,
              "name": {
                  "en": "Administrators",
                  "es": "Administrators",
                  "ca": "Administrators",
                  "it": "Administrators"
              }
          },
          {
              "iden": "Brands",
              "id": 73,
              "name": {
                  "en": "Brands",
                  "es": "Brands",
                  "ca": "Brands",
                  "it": "Brands"
              }
          },
          {
              "iden": "BrandServices",
              "id": 74,
              "name": {
                  "en": "BrandServices",
                  "es": "BrandServices",
                  "ca": "BrandServices",
                  "it": "BrandServices"
              }
          },
          {
              "iden": "Destinations",
              "id": 81,
              "name": {
                  "en": "Destinations",
                  "es": "Destinations",
                  "ca": "Destinations",
                  "it": "Destinations"
              }
          },
          {
              "iden": "Domains",
              "id": 84,
              "name": {
                  "en": "Domains",
                  "es": "Domains",
                  "ca": "Domains",
                  "it": "Domains"
              }
          },
          {
              "iden": "FeaturesRelBrands",
              "id": 85,
              "name": {
                  "en": "FeaturesRelBrands",
                  "es": "FeaturesRelBrands",
                  "ca": "FeaturesRelBrands",
                  "it": "FeaturesRelBrands"
              }
          },
          {
              "iden": "InvoiceTemplates",
              "id": 91,
              "name": {
                  "en": "InvoiceTemplates",
                  "es": "InvoiceTemplates",
                  "ca": "InvoiceTemplates",
                  "it": "InvoiceTemplates"
              }
          },
          {
              "iden": "SpecialNumbers",
              "id": 99,
              "name": {
                  "en": "SpecialNumbers",
                  "es": "SpecialNumbers",
                  "ca": "SpecialNumbers",
                  "it": "SpecialNumbers"
              }
          },
          {
              "iden": "WebPortals",
              "id": 101,
              "name": {
                  "en": "WebPortals",
                  "es": "WebPortals",
                  "ca": "WebPortals",
                  "it": "WebPortals"
              }
          },
          {
              "iden": "kam_rtpengine",
              "id": 102,
              "name": {
                  "en": "kam_rtpengine",
                  "es": "kam_rtpengine",
                  "ca": "kam_rtpengine",
                  "it": "kam_rtpengine"
              }
          },
          {
              "iden": "ApplicationServers",
              "id": 103,
              "name": {
                  "en": "ApplicationServers",
                  "es": "ApplicationServers",
                  "ca": "ApplicationServers",
                  "it": "ApplicationServers"
              }
          },
          {
              "iden": "MediaRelaySets",
              "id": 104,
              "name": {
                  "en": "MediaRelaySets",
                  "es": "MediaRelaySets",
                  "ca": "MediaRelaySets",
                  "it": "MediaRelaySets"
              }
          },
          {
              "iden": "ProxyTrunks",
              "id": 105,
              "name": {
                  "en": "ProxyTrunks",
                  "es": "ProxyTrunks",
                  "ca": "ProxyTrunks",
                  "it": "ProxyTrunks"
              }
          },
          {
              "iden": "ProxyUsers",
              "id": 106,
              "name": {
                  "en": "ProxyUsers",
                  "es": "ProxyUsers",
                  "ca": "ProxyUsers",
                  "it": "ProxyUsers"
              }
          },
          {
              "iden": "TerminalManufacturers",
              "id": 107,
              "name": {
                  "en": "TerminalManufacturers",
                  "es": "TerminalManufacturers",
                  "ca": "TerminalManufacturers",
                  "it": "TerminalManufacturers"
              }
          }
      ]
    """

  Scenario: Retrieve certain feature json
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "public_entities/81"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
          "iden": "Destinations",
          "fqdn": "Ivoz\\Provider\\Domain\\Model\\Destination\\Destination",
          "platform": true,
          "brand": true,
          "client": false,
          "id": 81,
          "name": {
              "en": "Destinations",
              "es": "Destinations",
              "ca": "Destinations",
              "it": "Destinations"
          }
      }
    """
