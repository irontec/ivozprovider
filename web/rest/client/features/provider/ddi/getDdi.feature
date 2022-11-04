Feature: Retrieve Ddis
  In order to manage Ddis
  As a client admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the Ddis json list
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "ddis"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      [
          {
              "ddi": "123",
              "ddie164": "+34123",
              "description": "Description for DDI 123",
              "routeType": null,
              "friendValue": "",
              "id": 1,
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
      ]
    """

  Scenario: Retrieve certain Ddi json
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "ddis/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "ddi": "123",
          "ddie164": "+34123",
          "description": "Description for DDI 123",
          "recordCalls": "none",
          "displayName": "",
          "routeType": null,
          "friendValue": "",
          "id": 1,
          "conferenceRoom": null,
          "language": null,
          "queue": null,
          "externalCallFilter": null,
          "user": null,
          "ivr": null,
          "huntGroup": null,
          "fax": null,
          "country": {
              "code": "ES",
              "countryCode": "+34",
              "id": 68,
              "name": {
                  "en": "Spain",
                  "es": "España",
                  "ca": "España"
              },
              "zone": {
                  "en": "Europe",
                  "es": "Europa",
                  "ca": "Europa"
              }
          },
          "residentialDevice": null,
          "conditionalRoute": null,
          "retailAccount": null
      }
    """
