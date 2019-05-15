Feature: Create residential devices
  In order to manage residential devices
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a residential device
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/residential_devices" with body:
    """
      {
          "name": "newRetail",
          "description": "",
          "transport": "udp",
          "company": 1,
          "outgoingDdi": null,
          "language": null
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "name": "newRetail",
          "description": "",
          "transport": "udp",
          "id": 2,
          "company": 1,
          "transformationRuleSet": null,
          "outgoingDdi": null,
          "language": null
      }
    """

  Scenario: Retrieve created residential device
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "residential_devices/2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "name": "newRetail",
          "description": "",
          "transport": "udp",
          "id": 2,
          "company":
          "~",
          "transformationRuleSet": null,
          "outgoingDdi": null,
          "language": null
      }
    """
