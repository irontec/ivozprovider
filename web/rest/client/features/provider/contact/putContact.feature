Feature: Update contacts
  In order to manage contacts
  As a client admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a contacts
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/contacts/1" with body:
    """
      {
          "name": "Updated",
          "lastname": "Contact",
          "workPhoneCountry": 65,
          "workPhone": "222333444",
          "mobilePhoneCountry": 65,
          "mobilePhone": "444333222",
          "otherPhone": "1004"
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be like:
    """
      {
          "name": "Updated",
          "lastname": "Contact",
          "email": "testcontact@email.com",
          "workPhone": "222333444",
          "workPhoneE164": "+20222333444",
          "mobilePhone": "444333222",
          "mobilePhoneE164": "+20444333222",
          "otherPhone": "1004",
          "id": 1,
          "user": null,
          "workPhoneCountry": 65,
          "mobilePhoneCountry": 65
      }
    """
