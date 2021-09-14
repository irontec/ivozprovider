Feature: Retrieve unassigned services
  In order to manage services
  As a client admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the unassigned services json list
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "services/unassigned"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      [
          {
              "iden": "CloseLock",
              "defaultCode": "30",
              "extraArgs": true,
              "id": 5,
              "name": {
                  "en": "en",
                  "es": "es",
                  "ca": "ca",
                  "it": "it"
              }
          }
      ]
    """

  @createSchema
  Scenario: Retrieve the unassigned services including requested id json list
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "services/unassigned?_includeId=1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      [
          {
              "iden": "DirectPickUp",
              "defaultCode": "94",
              "extraArgs": true,
              "id": 1,
              "name": {
                  "en": "en",
                  "es": "es",
                  "ca": "ca",
                  "it": "it"
              }
          },
          {
              "iden": "CloseLock",
              "defaultCode": "30",
              "extraArgs": true,
              "id": 5,
              "name": {
                  "en": "en",
                  "es": "es",
                  "ca": "ca",
                  "it": "it"
              }
          }
      ]
    """