Feature: Update residential device
  In order to manage call forward settings
  As a brand admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a ddi
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/residential_devices/1" with body:
      """
      {
          "name": "updatedResidentialDevice",
          "description": "",
          "transport": "udp",
          "ip": "1.2.3.4",
          "port": 1024,
          "password": "+rA778Li2dL",
          "allow": "alaw",
          "fromDomain": null,
          "directConnectivity": "yes",
          "ddiIn": "yes",
          "maxCalls": 1,
          "t38Passthrough": "no",
          "id": 1,
          "company": 1,
          "transformationRuleSet": null,
          "outgoingDdi": null,
          "language": null
      }
      """
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "name": "updatedResidentialDevice",
          "description": "",
          "transport": "udp",
          "ip": "1.2.3.4",
          "port": 1024,
          "password": "+rA778Li2dL",
          "allow": "alaw",
          "fromDomain": null,
          "directConnectivity": "yes",
          "ddiIn": "yes",
          "maxCalls": 1,
          "t38Passthrough": "no",
          "rtpEncryption": false,
          "multiContact": true,
          "id": 1,
          "company": 1,
          "transformationRuleSet": null,
          "outgoingDdi": null,
          "language": null
      }
      """
