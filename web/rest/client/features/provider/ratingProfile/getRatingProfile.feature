Feature: Retrieve rating profiles
  In order to manage rating profiles
  As a client admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the rating profiles json list
    Given I add Company Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "rating_profiles"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
          {
              "activationTime": "2018-02-02 21:20:20",
              "id": 1,
              "company": 1
          },
          {
              "activationTime": "2018-02-02 21:20:20",
              "id": 2,
              "company": 1
          }
      ]
    """

  Scenario: Retrieve certain rating profile json
    Given I add Company Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "rating_profiles/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
          "activationTime": "2018-02-02 21:20:20",
          "id": 1,
          "company": {
              "type": "vpbx",
              "name": "DemoCompany",
              "domainUsers": "127.0.0.1",
              "nif": "12345678A",
              "onDemandRecordCode": "",
              "balance": 1.2,
              "id": 1,
              "language": 1,
              "defaultTimezone": 145,
              "country": 68,
              "transformationRuleSet": 1,
              "outgoingDdi": null,
              "outgoingDdiRule": null
          }
      }
    """
