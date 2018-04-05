Feature: Retrieve faxes in outs
  In order to manage faxes in out
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the faxes in out json list
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "faxes_in_outs"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
          {
              "calldate": "2018-01-01 01:00:00",
              "src": "34688888888",
              "dst": "34688888881",
              "type": "In",
              "status": "error",
              "id": 1
          }
      ]
    """

  Scenario: Retrieve certain faxes in out json
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "faxes_in_outs/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
          "calldate": "2018-01-01 01:00:00",
          "src": "34688888888",
          "dst": "34688888881",
          "type": "In",
          "pages": null,
          "status": "error",
          "id": 1,
          "file": {
              "fileSize": null,
              "mimeType": null,
              "baseName": null
          },
          "fax": {
              "name": "Test Fax",
              "email": null,
              "sendByEmail": false,
              "id": 1,
              "company": 1,
              "outgoingDdi": null
          },
          "dstCountry": null
      }
    """
