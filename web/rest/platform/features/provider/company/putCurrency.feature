Feature: Manage currencies
  In order to manage currencies
  as a super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Can update a currency
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/currencies/3" with body:
      """
      {
        "iden": "AUD",
        "symbol": "$",
        "name": {
            "en": "Australia Dólar",
            "es": "Australia Dólar",
            "ca": "Australia Dólar",
            "it": "Australia Dólar"
        }
      }
      """
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
        "iden": "AUD",
        "symbol": "$",
        "id": 3,
        "name": {
            "en": "Australia Dólar",
            "es": "Australia Dólar",
            "ca": "Australia Dólar",
            "it": "Australia Dólar"
        }
      }
      """
