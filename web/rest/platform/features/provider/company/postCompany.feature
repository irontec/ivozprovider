Feature: Cannot Manage companies
  In order to manage companies
  as a super admin
  I don't need to be able to create them through the API.

  @createSchema
  Scenario: Cannot Create a company object
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/companies" with body:
      """
      {
        "type": "vpbx",
        "name": "vpbxTest",
        "distributeMethod": "hash",
        "domainUsers": "127.0.0.2",
        "maxCalls": "20",
        "maxDailyUsage": "1000000",
        "allowRecordingRemoval": "1",
        "billingMethod": "postpaid",
        "brand": 1,
        "country": 1
      }
      """
     Then the response status code should be 405
