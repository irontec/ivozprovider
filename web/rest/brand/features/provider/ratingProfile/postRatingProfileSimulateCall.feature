Feature: Simulate Call rating plan group
  In order to simulate call rating plan group
  As a brand admin
  I need to be able to simulate them through the API.

  @createSchema
  Scenario: Simulate a call for rating plan groups
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/x-www-form-urlencoded"
      And I add "Accept" header equal to "application/json"
     When I send a "POST" request to "/rating_profiles/1/simulate_call" with parameters:
      | key      | value   |
      | number   | +342654 |
      | duration | 20      |
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "plan": "Something",
          "callDate": "2023-01-24 10:51:44",
          "duration": 20,
          "patternName": "Dest3 (+346)",
          "connectionCharge": 0,
          "intervalStart": "0",
          "rate": 0.0025,
          "ratePeriod": 1,
          "totalCost": 0.15,
          "currencySymbol": "€"
      }
      """
