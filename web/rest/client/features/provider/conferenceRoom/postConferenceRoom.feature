Feature: Create conference rooms
  In order to manage conference rooms
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a conference room
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/conference_rooms" with body:
    """
      {
          "name": "newConferenceRoom",
          "pinProtected": true,
          "pinCode": "1234",
          "maxMembers": 1,
          "company": 2
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "name": "newConferenceRoom",
          "pinProtected": true,
          "maxMembers": 1,
          "id": 2
      }
    """

  Scenario: Retrieve created conference room
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "conference_rooms/2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "name": "newConferenceRoom",
          "pinProtected": true,
          "pinCode": "1234",
          "maxMembers": 1,
          "id": 2,
          "company": "~"
      }
    """
