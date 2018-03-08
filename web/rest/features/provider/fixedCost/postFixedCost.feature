Feature: Create fixed costs
  In order to manage fixed costs
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a fixed cost
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/fixed_costs" with body:
    """
      {
          "name": "24x7 support",
          "description": "Something",
          "cost": "10",
          "id": 1,
          "brand": 1
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "name": "24x7 support",
          "id": 2
      }
    """

  Scenario: Retrieve created fixed cost
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "fixed_costs/2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
          "name": "24x7 support",
          "description": "Something",
          "cost": "10",
          "id": 2,
          "brand": {
              "name": "DemoBrand",
              "domainUsers": "",
              "fromName": "",
              "fromAddress": "",
              "recordingsLimitMB": null,
              "recordingsLimitEmail": "",
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
