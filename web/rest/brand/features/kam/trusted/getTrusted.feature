Feature: Retrieve Trusted addresses
  In order to manage Trusted addresses
  As a brand admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the Trusted addresses json list
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "trusteds"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      [
          {
              "srcIp": "194.30.6.32",
              "description": null,
              "id": 1
          }
      ]
    """

  Scenario: Retrieve certain Trusted addresses json
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "trusteds/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "srcIp": "194.30.6.32",
          "proto": "any",
          "fromPattern": null,
          "ruriPattern": null,
          "tag": "1",
          "description": null,
          "priority": 0,
          "id": 1,
          "company": "~"
      }
    """
