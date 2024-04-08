Feature: Create domains
  In order to manage domains
  as a client admin
  I should not be able to create them through the API.

  @createSchema
  Scenario: Create domains item
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/domains" with body:
      """
      {
      	"domain": "test2.irontec.com",
      	"pointsTo": "proxyusers",
      	"brandName": "",
      	"companyName": "Irontec Test2 Company"
      }
      """
     Then the response status code should be 405
