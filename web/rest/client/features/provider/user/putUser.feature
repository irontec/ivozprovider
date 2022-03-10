Feature: Update users
  In order to manage users
  As a client admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a user
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/users/1" with body:
    """
      {
          "name": "Updated",
          "lastname": "User",
          "email": "alice@democompany.com",
          "doNotDisturb": false,
          "isBoss": false,
          "active": true,
          "maxCalls": 1,
          "externalIpCalls": "0",
          "rejectCallMethod": "rfc",
          "gsQRCode": false,
          "id": 1,
          "callAcl": null,
          "bossAssistant": null,
          "bossAssistantWhiteList": null,
          "transformationRuleSet": 1,
          "language": null,
          "terminal": 1,
          "extension": null,
          "timezone": 145,
          "outgoingDdi": null,
          "outgoingDdiRule": null,
          "voicemail": null,
          "pickupGroupIds": [
            1
          ]
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "name": "Updated",
          "lastname": "User",
          "email": "alice@democompany.com",
          "pass": "*****",
          "doNotDisturb": false,
          "isBoss": false,
          "active": true,
          "maxCalls": 1,
          "externalIpCalls": "0",
          "rejectCallMethod": "rfc",
          "multiContact": true,
          "gsQRCode": false,
          "id": 1,
          "callAcl": null,
          "bossAssistant": null,
          "bossAssistantWhiteList": null,
          "transformationRuleSet": 1,
          "language": null,
          "terminal": 1,
          "extension": null,
          "timezone": 145,
          "outgoingDdi": null,
          "outgoingDdiRule": null,
          "voicemail": null,
          "pickupGroupIds": [
            1
          ]
      }
    """

  Scenario: Update a password
    Given I add Company Authorization header
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "PUT" request to "/users/1" with body:
    """
      {
          "pass": "newPass",
          "oldPass": "changeme"
      }
    """
    Then the response status code should be 200


  Scenario: Active user requires a password
    Given I add Company Authorization header
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "PUT" request to "/users/1" with body:
    """
      {
          "pass": null,
          "oldPass": "changeme"
      }
    """
    Then the response status code should be 400
