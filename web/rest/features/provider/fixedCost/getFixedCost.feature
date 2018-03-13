Feature: Retrieve fixed costs
  In order to manage fixed costs
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the fixed costs json list
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "fixed_costs"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
          {
              "name": "Monitoring",
              "id": 1
          }
      ]
    """

  Scenario: Retrieve certain fixed cost json
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "fixed_costs/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
          "name": "Monitoring",
          "description": "Something",
          "cost": "1",
          "id": 1,
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
          }
      }
    """
