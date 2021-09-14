Feature: Retrieve services
  In order to manage services
  as a super admin
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
              "id": 1,
              "name": {
                  "en": "en",
                  "es": "es",
                  "ca": "ca",
                  "it": "it"
              }
          },
          {
              "iden": "GroupPickUp",
              "defaultCode": "95",
              "extraArgs": false,
              "id": 2,
              "name": {
                  "en": "en",
                  "es": "es",
                  "ca": "ca",
                  "it": "it"
              }
          },
          {
              "iden": "Voicemail",
              "defaultCode": "93",
              "extraArgs": true,
              "id": 3,
              "name": {
                  "en": "en",
                  "es": "es",
                  "ca": "ca",
                  "it": "it"
              }
          },
          {
              "iden": "RecordLocution",
              "defaultCode": "00",
              "extraArgs": true,
              "id": 4,
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
              "es": "es",
              "ca": "ca",
              "it": "it"
          },
          "description": {
              "en": "en",
              "es": "es",
              "ca": "ca",
              "it": "it"
          }
      }
    """
