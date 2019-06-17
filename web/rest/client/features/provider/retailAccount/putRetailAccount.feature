Feature: Update retail accounts
  In order to manage retail accounts
  As a client admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a retail account
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/retail_accounts/1" with body:
    """
      {
          "name": "updatedRetailAccount",
          "description": "updated desc",
          "transformationRuleSet": 1,
          "outgoingDdi": 1
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be like:
    """
      {
          "name": "updatedRetailAccount",
          "description": "updated desc",
          "transport": "udp",
          "password": "9rv6G3TVc-",
          "id": 1,
          "company": {
              "type": "vpbx",
              "name": "DemoCompany",
              "domainUsers": "127.0.0.1",
              "nif": "12345678A",
              "onDemandRecordCode": "",
              "balance": 1.2,
              "id": 1,
              "language": 1,
              "defaultTimezone": 145,
              "country": 68,
              "transformationRuleSet": 1,
              "outgoingDdi": null,
              "outgoingDdiRule": null
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
              "country": 68
          },
          "outgoingDdi": {
              "ddi": "123",
              "recordCalls": "none",
              "displayName": "",
              "routeType": null,
              "friendValue": "",
              "id": 1,
              "company": 1,
              "conferenceRoom": null,
              "language": null,
              "queue": null,
              "externalCallFilter": null,
              "user": null,
              "ivr": null,
              "huntGroup": null,
              "fax": null,
              "country": 68,
              "residentialDevice": null,
              "conditionalRoute": null,
              "retailAccount": null
          }
      }
    """
