Feature: Retrieve residential devices
  In order to manage residential devices
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the residential devices json list
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "residential_devices"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
          {
              "name": "retail",
              "transport": "udp",
              "authNeeded": "yes",
              "id": 1
          }
      ]
    """

  Scenario: Retrieve certain residential device json
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "residential_devices/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be like:
    """
      {
          "name": "retail",
          "description": "",
          "transport": "udp",
          "ip": null,
          "port": null,
          "authNeeded": "yes",
          "password": "****",
          "disallow": "all",
          "allow": "alaw",
          "directMediaMethod": "invite",
          "calleridUpdateHeader": "pai",
          "updateCallerid": "yes",
          "fromDomain": null,
          "directConnectivity": "yes",
          "id": 1,
          "company": "~",
          "transformationRuleSet": null,
          "outgoingDdi": null,
          "language": null
      }
    """
