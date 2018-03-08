Feature: Retrieve services
  In order to manage services
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the services json list
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "services"
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
              "id": 1
          },
          {
              "iden": "GroupPickUp",
              "defaultCode": "95",
              "extraArgs": false,
              "id": 2
          },
          {
              "iden": "Voicemail",
              "defaultCode": "93",
              "extraArgs": true,
              "id": 3
          },
          {
              "iden": "RecordLocution",
              "defaultCode": "00",
              "extraArgs": true,
              "id": 4
          }
      ]
    """

  Scenario: Retrieve certain service json
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "services/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
          "iden": "DirectPickUp",
          "defaultCode": "94",
          "extraArgs": true,
          "id": 1,
          "name": {
              "en": "en",
              "es": "en"
          },
          "description": {
              "en": "en",
              "es": "en"
          }
      }
    """
