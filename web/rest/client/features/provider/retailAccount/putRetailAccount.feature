Feature: Update retail accounts
  In order to manage retail accounts
  As a client admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a retail account
    Given I add Retail Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/retail_accounts/1" with body:
    """
      {
          "name": "updatedRetailAccount",
          "description": "updated desc",
          "transformationRuleSet": 1,
          "outgoingDdi": 3
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
                  "ca": "ca"
              },
              "country": 68
          },
          "outgoingDdi": {
              "ddi": "121",
              "recordCalls": "none",
              "displayName": "",
              "routeType": null,
              "friendValue": "",
              "id": 3,
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
