Feature: Manage companies
  In order to manage companies
  as a super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the company json list
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "companies"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "type": "vpbx",
              "name": "DemoCompany",
              "maxDailyUsage": 2,
              "currentDayUsage": 1,
              "billingMethod": "prepaid",
              "id": 1,
              "invoicing": {
                  "nif": "12345678A"
              },
              "domainName": "127.0.0.1"
          },
          {
              "type": "vpbx",
              "name": "Irontec Test Company",
              "maxDailyUsage": 1000000,
              "currentDayUsage": 0,
              "billingMethod": "postpaid",
              "id": 2,
              "invoicing": {
                  "nif": "12345678-Z"
              },
              "domainName": "test.irontec.com"
          },
          {
              "type": "retail",
              "name": "Retail Company",
              "maxDailyUsage": 1000000,
              "currentDayUsage": 0,
              "billingMethod": "postpaid",
              "id": 3,
              "invoicing": {
                  "nif": "12345679-Z"
              },
              "domainName": "retail.irontec.com"
          },
          {
              "type": "residential",
              "name": "Residential Company",
              "maxDailyUsage": 1000000,
              "currentDayUsage": 0,
              "billingMethod": "postpaid",
              "id": 4,
              "invoicing": {
                  "nif": "12345679-Z"
              },
              "domainName": "retail.irontec.com"
          },
          {
              "type": "wholesale",
              "name": "Wholesale Company",
              "maxDailyUsage": 1000000,
              "currentDayUsage": 0,
              "billingMethod": "postpaid",
              "id": 5,
              "invoicing": {
                  "nif": "12345689-Z"
              },
              "domainName": null
          }
      ]
      """

  Scenario: Retrieve certain company json
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "companies/1"
     Then the response status code should be 404
