Feature: Manage companies
  In order to manage companies
  as a super admin
  I won't to be able to update them through the API.

  @createSchema
  Scenario: Cannot update a company
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/companies/1" with body:
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
     Then the response status code should be 404
