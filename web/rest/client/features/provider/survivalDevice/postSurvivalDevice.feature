Feature: Create a survival device
  In order to manage survival devices
  As a client admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a survival devices
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "survival_devices" with body:
      """
      {
        "name": "Survival Test 1",
        "proxy": "survival1.test.com",
        "outboundProxy": "192.168.1.100:5060",
        "udpPort": 5060,
        "tcpPort": 5060,
        "tlsPort": 5061,
        "wssPort": 10081,
        "description": "new survival device 1"
      }
      """
     Then the response status code should be 201
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "name": "Survival Test 1",
          "proxy": "survival1.test.com",
          "outboundProxy": "192.168.1.100:5060",
          "udpPort": 5060,
          "tcpPort": 5060,
          "tlsPort": 5061,
          "wssPort": 10081,
          "description": "new survival device 1",
          "id": 5,
          "company": 1
      }
      """
