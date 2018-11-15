Feature: Update conference rooms
  In order to manage conference rooms
  As an super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a conference room
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/conference_rooms/1" with body:
    """
      {
          "name": "updatedConferenceRoom",
          "pinProtected": false,
          "pinCode": null,
          "maxMembers": 1,
          "id": 1,
          "company": 2
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be like:
    """
      {
          "name": "updatedConferenceRoom",
          "pinProtected": false,
          "pinCode": null,
          "maxMembers": 1,
          "id": 1,
          "company": "~"
      }
    """
