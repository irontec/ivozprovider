Feature: Manage currencies
  In order to manage currencies
  as a super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Can't update a currency
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/currencies/2" with body:
      """
      {
        "name": "api_currency_modified",
        "domainUsers": "sip-api.irontec.com",
        "recordingsLimitMB": 0,
        "recordingsLimitEmail": "",
        "invoice": {
          "nif": "1234",
          "postalAddress": "",
          "postalCode": "48960",
          "town": "",
          "province": "",
          "country": "",
          "registryData": ""
        },
        "language": 1,
        "defaultTimezone": 145,
        "features": [1]
      }
      """
     Then the response status code should be 404
