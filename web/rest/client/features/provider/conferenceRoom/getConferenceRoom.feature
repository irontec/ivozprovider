Feature: Retrieve conference rooms
  In order to manage conference rooms
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the conference rooms json list
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "conference_rooms"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      [
          {
              "name": "testConferenceRoom",
              "pinProtected": true,
              "maxMembers": 1,
              "id": 1
          }
      ]
    """

  Scenario: Retrieve certain conference room json
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "conference_rooms/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be like:
    """
      {
          "name": "testConferenceRoom",
          "pinProtected": true,
          "pinCode": "4321",
          "maxMembers": 1,
          "id": 1,
          "company": "~"
      }
    """
