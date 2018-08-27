Feature: Create faxes in outs
  In order to manage faxes in outs
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a faxes in out
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/faxes_in_outs" with body:
    """
      {
          "calldate": "2018-01-01 00:00:00",
          "src": "34688888889",
          "dst": "34688888888",
          "type": "Out",
          "pages": null,
          "status": "pending",
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
              "outgoingDdi": null
          },
          "dstCountry": 1
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "calldate": "2018-01-01 00:00:00",
          "src": "34688888889",
          "dst": "34688888888",
          "type": "Out",
          "status": "pending",
          "id": 2
      }
    """

  Scenario: Retrieve created faxes in out
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "faxes_in_outs/2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
          "calldate": "2018-01-01 00:00:00",
          "src": "34688888889",
          "dst": "34688888888",
          "type": "Out",
          "pages": null,
          "status": "pending",
          "id": 2,
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
          "dstCountry": {
              "code": "ES",
              "countryCode": "+34",
              "id": 1,
              "name": {
                  "en": "Spain",
                  "es": "España"
              },
              "zone": {
                  "en": "Europe",
                  "es": "Europa"
              }
          }
      }
    """
