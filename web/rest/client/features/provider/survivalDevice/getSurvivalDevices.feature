Feature: Retrieve survival devices
  In order to manage survival devices
  As a client admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the survival devices JSON list
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "survival_devices"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "name": "Survival Test 3",
              "proxy": "survival3.test.com",
              "description": "new survival device 3",
              "id": 3
          },
          {
              "name": "Survival Test 4",
              "proxy": "survival4.test.com",
              "description": "new survival device 4",
              "id": 4
          },
          {
              "name": "survival test 1",
              "proxy": "survival1.test.com",
              "description": "new survival device 1",
              "id": 1
          }
      ]
      """

  Scenario: Retrieve certain survival device json
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "survival_devices/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
       {
          "name": "survival test 1",
          "proxy": "survival1.test.com",
          "outboundProxy": "192.168.1.100:5060",
          "udpPort": 5060,
          "tcpPort": 5060,
          "tlsPort": 5061,
          "wssPort": 10081,
          "description": "new survival device 1",
          "id": 1,
          "company": {
              "type": "vpbx",
              "name": "DemoCompany",
              "domainUsers": "127.0.0.1",
              "onDemandRecordCode": "",
              "balance": 1.2,
              "id": 1,
              "invoicing": {
                  "nif": "12345678A"
              },
              "language": 1,
              "defaultTimezone": 145,
              "country": 68,
              "transformationRuleSet": 1,
              "outgoingDdi": null,
              "outgoingDdiRule": null
          }
      }
      """
