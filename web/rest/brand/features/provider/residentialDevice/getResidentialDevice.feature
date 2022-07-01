Feature: Retrieve residential devices
  In order to manage residential devices
  As a brand admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the residential devices json list
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "residential_devices"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      [
          {
              "name": "residentialDevice",
              "transport": "udp",
              "id": 1
          }
      ]
    """

  Scenario: Retrieve certain residential device json
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "residential_devices/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "name": "residentialDevice",
          "description": "",
          "transport": "udp",
          "ip": "1.2.3.4",
          "port": 1024,
          "password": "+rA778LidL",
          "allow": "alaw",
          "fromDomain": null,
          "directConnectivity": "no",
          "ddiIn": "yes",
          "maxCalls": 1,
          "t38Passthrough": "no",
          "id": 1,
          "company": "~",
          "transformationRuleSet": null,
          "outgoingDdi": null,
          "language": null
      }
    """
