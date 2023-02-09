Feature: Manage currencies
  In order to manage currencies
  as a super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the currency json list
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "currencies"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      [
          {
              "iden": "EUR",
              "symbol": "\u20ac",
              "id": 1,
              "name": {
                  "en": "Euro",
                  "es": "Euro",
                  "ca": "Euro",
                  "it": "Euro"
              }
          },
          {
              "iden": "USD",
              "symbol": "$",
              "id": 2,
              "name": {
                  "en": "Dollar",
                  "es": "D\u00f3llar",
                  "ca": "Dollar",
                  "it": "Dollar"
              }
          },
          {
              "iden": "GBP",
              "symbol": "\u00a3",
              "id": 3,
              "name": {
                  "en": "Pound",
                  "es": "Libra",
                  "ca": "Libra",
                  "it": "Pound"
              }
          }
      ]
    """

  Scenario: Retrieve certain currency json
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "currencies/1"
     Then the response status code should be 404
