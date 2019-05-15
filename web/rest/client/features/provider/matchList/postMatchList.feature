Feature: Create match lists
  In order to manage match lists
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a match list
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/match_lists" with body:
    """
      {
          "name": "newMatchlist"
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "name": "newMatchlist",
          "id": 3,
          "company": 1
      }
    """

  Scenario: Retrieve created match list
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "/match_lists/3"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
          "name": "newMatchlist",
          "id": 3,
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
