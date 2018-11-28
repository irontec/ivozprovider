Feature: Retrieve locutions
  In order to manage locutions
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the locutions json list
    Given I add Company Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "locutions"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
          {
              "name": "testLocution",
              "status": null,
              "id": 1
          }
      ]
    """

  Scenario: Retrieve certain locutions json
    Given I add Company Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "locutions/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be like:
    """
      {
          "name": "testLocution",
          "status": null,
          "id": 1,
          "encodedFile": {
              "fileSize": 1,
              "mimeType": "audio/x-wav; charset=binary",
              "baseName": "locution.wav"
          },
          "originalFile": {
              "fileSize": 1,
              "mimeType": "audio/mpeg; charset=binary",
              "baseName": "locution.mp3"
          },
          "company": "~"
      }
    """
