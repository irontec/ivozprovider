Feature: Retrieve domains
  In order to manage domains
  as a super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the domain json list
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "domains"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "domain": "127.0.0.1",
              "pointsTo": "proxyusers",
              "id": 3,
              "brandName": "",
              "companyName": "DemoCompany"
          },
          {
              "domain": "retail.irontec.com",
              "pointsTo": "proxyusers",
              "id": 6,
              "brandName": "",
              "companyName": ""
          },
          {
              "domain": "sip.irontec.com",
              "pointsTo": "proxyusers",
              "id": 4,
              "brandName": "Irontec_e2e",
              "companyName": ""
          },
          {
              "domain": "test.irontec.com",
              "pointsTo": "proxyusers",
              "id": 5,
              "brandName": "",
              "companyName": "Irontec Test Company"
          }
      ]
      """

  Scenario: Retrieve certain domain json
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "domains/3"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "domain": "127.0.0.1",
          "pointsTo": "proxyusers",
          "description": "DemoCompany proxyusers domain",
          "id": 3
      }
      """
