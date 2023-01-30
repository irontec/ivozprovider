Feature: Retrieve companies
  In order to manage companies
  As a client admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the companies json list
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "companies"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      [
          {
              "type": "vpbx",
              "name": "DemoCompany",
              "nif": "12345678A",
              "id": 1,
              "domainName": "127.0.0.1"
          }
      ]
    """

  Scenario: Retrieve certain company service json
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "companies/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "type": "vpbx",
          "name": "DemoCompany",
          "domainUsers": "127.0.0.1",
          "nif": "12345678A",
          "onDemandRecordCode": "",
          "balance": 1.2,
          "id": 1,
          "language": {
              "iden": "es",
              "id": 1,
              "name": {
                  "en": "es",
                  "es": "es",
                  "ca": "es",
                  "it": "es"
              }
          },
          "defaultTimezone": {
              "tz": "Europe/Madrid",
              "comment": "mainland",
              "id": 145,
              "label": {
                  "en": "en",
                  "es": "es",
                  "ca": "ca",
                  "it": "it"
              },
              "country": 68
          },
          "country": {
              "code": "ES",
              "countryCode": "+34",
              "id": 68,
              "name": {
                  "en": "Spain",
                  "es": "España",
                  "ca": "España",
                  "it": "Spagna"
              },
              "zone": {
                  "en": "Europe",
                  "es": "Europa",
                  "ca": "Europa",
                  "it": "Europe"
              }
          },
          "transformationRuleSet": {
              "description": "Generic transformation for Spain",
              "internationalCode": "00",
              "trunkPrefix": "",
              "areaCode": "",
              "nationalLen": 9,
              "generateRules": false,
              "id": 1,
              "name": {
                  "en": "en",
                  "es": "es",
                  "ca": "ca",
                  "it": "it"
              },
              "country": 68
          },
          "outgoingDdi": null,
          "outgoingDdiRule": null
      }
    """
