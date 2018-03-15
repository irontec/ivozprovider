Feature: Create peering contracts
  In order to manage peering contracts
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a peering contracts
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/peering_contracts" with body:
    """
      {
          "description": "Artemis-New",
          "name": "Artemis-New",
          "externallyRated": false,
          "brand": 1,
          "transformationRuleSet": 1
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "description": "Artemis-New",
          "name": "Artemis-New",
          "externallyRated": false,
          "id": 2
      }
    """

  Scenario: Retrieve created peering contract
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "/peering_contracts/2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
          "description": "Artemis-New",
          "name": "Artemis-New",
          "externallyRated": false,
          "id": 2,
          "brand": {
              "name": "DemoBrand",
              "domainUsers": "",
              "fromName": "",
              "fromAddress": "",
              "recordingsLimitMB": null,
              "recordingsLimitEmail": "",
              "maxCalls": 0,
              "id": 1,
              "logo": {
                  "fileSize": null,
                  "mimeType": null,
                  "baseName": null
              },
              "invoice": {
                  "nif": "",
                  "postalAddress": "",
                  "postalCode": "",
                  "town": "",
                  "province": "",
                  "country": "",
                  "registryData": ""
              },
              "domain": 6,
              "language": 1,
              "defaultTimezone": 1
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
                  "es": "es"
              },
              "brand": null,
              "country": 1
          }
      }
    """
