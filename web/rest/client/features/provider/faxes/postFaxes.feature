Feature: Create faxes
  In order to manage faxes
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a fax
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/faxes" with body:
    """
      {
          "name": "New Fax",
          "email": "something@irontec.com",
          "sendByEmail": true,
          "company": 1,
          "outgoingDdi": null
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "name": "New Fax",
          "email": "something@irontec.com",
          "sendByEmail": true,
          "id": 2
      }
    """

  Scenario: Retrieve created fax
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "faxes/2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "name": "New Fax",
          "email": "something@irontec.com",
          "sendByEmail": true,
          "id": 2,
          "company": "~",
          "outgoingDdi": null
      }
    """
