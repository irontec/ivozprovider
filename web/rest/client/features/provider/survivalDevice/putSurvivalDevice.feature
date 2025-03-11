Feature: Update survival devices
  In order to manage terminals
  As a client admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a survival devices
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/survival_devices/1" with body:
      """
      {
        "name": "Survival Test 1-1",
        "proxy": "55555",
        "outboundProxy": "66666",
        "udpPort": 5065,
        "tcpPort": 5065,
        "tlsPort": 5066,
        "wssPort": 10085,
        "description": "new survival device 1-1"
      }
      """
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "name": "Survival Test 1-1",
          "proxy": "55555",
          "outboundProxy": "66666",
          "udpPort": 5065,
          "tcpPort": 5065,
          "tlsPort": 5066,
          "wssPort": 10085,
          "description": "new survival device 1-1",
          "id": 1,
          "company": 1
      }
      """
