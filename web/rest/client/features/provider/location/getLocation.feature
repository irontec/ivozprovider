Feature: Retrieve locations
  In order to manage locations
  As a client admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the locations json list
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "locations"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "name": "altLocation",
              "description": "Alternative Location description",
              "id": 2,
              "survivalDevice": null
          },
          {
              "name": "testLocation",
              "description": "Test Location description",
              "id": 1,
              "survivalDevice": 1
          }
      ]
      """

  @createSchema
  Scenario: Retrieve certain locations json
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "locations/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "name": "testLocation",
          "description": "Test Location description",
          "id": 1,
          "survivalDevice": {
              "name": "survival test 1",
              "proxy": "survival1.test.com",
              "outboundProxy": "192.168.1.100:5060",
              "udpPort": 5060,
              "tcpPort": 5060,
              "tlsPort": 5061,
              "wssPort": 10081,
              "description": "new survival device 1",
              "id": 1,
              "company": 1
          },
          "userIds": [
              1,
              2,
              3
          ]
      }
      """
