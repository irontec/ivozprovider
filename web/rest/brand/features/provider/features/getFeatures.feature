Feature: Retrieve features
  In order to manage features
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the features json list
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "features"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      [
          {
              "iden": "queues",
              "id": 1
          },
          {
              "iden": "recordings",
              "id": 2
          },
          {
              "iden": "faxes",
              "id": 3
          },
          {
              "iden": "friends",
              "id": 4
          },
          {
              "iden": "conferences",
              "id": 5
          },
          {
              "iden": "billing",
              "id": 6
          },
          {
              "iden": "invoices",
              "id": 7
          },
          {
              "iden": "progress",
              "id": 8
          },
          {
              "iden": "retail",
              "id": 9
          }
      ]
    """

  Scenario: Retrieve certain feature json
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "features/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
          "iden": "queues",
          "id": 1,
          "name": {
              "en": "en",
              "es": "es"
          }
      }
    """
