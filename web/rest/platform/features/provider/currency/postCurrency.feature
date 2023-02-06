Feature: Manage currencies
  In order to manage currencies
  as a super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Can't create a currency
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/currencies" with body:
      """
      {
        "name": "api_currency",
        "domainUsers": "sip-api.irontec.com",
        "invoice": {
          "nif": "123",
          "postalAddress": "",
          "postalCode": "48971",
          "town": "Bilbo",
          "province": "Bizkaia",
          "country": "Spain",
          "registryData": "registryData"
        },
        "defaultTimezone": 145,
        "currency": 1
      }
      """
     Then the response status code should be 405
