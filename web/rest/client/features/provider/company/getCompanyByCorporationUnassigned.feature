Feature: Retrieve companies
  In order to manage companies
  As a client admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve certain companies by corporate unassigned json
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "companies/corporate/unassigned"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "type": "vpbx",
              "name": "Irontec Test Company",
              "id": 2,
              "invoicing": {
                  "nif": "12345678-Z"
              },
              "domainName": "test.irontec.com"
          }
      ]
      """
