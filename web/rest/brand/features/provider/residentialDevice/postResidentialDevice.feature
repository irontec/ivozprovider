Feature: Create residential devices
  In order to manage residential devices
  As a brand admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a residential device
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/residential_devices" with body:
      """
      {
          "name": "testResidentialDevice",
          "description": "demo description",
          "transport": "udp",
          "ip": "1.2.3.4",
          "port": 1024,
          "password": "qq6G+As2M7",
          "allow": "alaw",
          "fromDomain": null,
          "directConnectivity": "yes",
          "ddiIn": "yes",
          "maxCalls": 1,
          "t38Passthrough": "no",
          "company": 4,
          "transformationRuleSet": null,
          "outgoingDdi": null,
          "language": null,
          "proxyUser": 1
      }
      """
     Then the response status code should be 201
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "name": "testResidentialDevice",
          "description": "demo description",
          "transport": "udp",
          "ip": "1.2.3.4",
          "port": 1024,
          "password": "qq6G+As2M7",
          "allow": "alaw",
          "fromDomain": null,
          "directConnectivity": "yes",
          "ddiIn": "yes",
          "maxCalls": 1,
          "t38Passthrough": "no",
          "rtpEncryption": false,
          "multiContact": true,
          "ruriDomain": null,
          "id": 7,
          "company": 4,
          "transformationRuleSet": null,
          "outgoingDdi": null,
          "language": null,
          "proxyUser": 1
      }
      """

  Scenario: Retrieve created residential device
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "residential_devices/7"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "name": "testResidentialDevice",
          "description": "demo description",
          "transport": "udp",
          "ip": "1.2.3.4",
          "port": 1024,
          "password": "qq6G+As2M7",
          "allow": "alaw",
          "fromDomain": null,
          "directConnectivity": "yes",
          "ddiIn": "yes",
          "maxCalls": 1,
          "t38Passthrough": "no",
          "rtpEncryption": false,
          "multiContact": true,
          "ruriDomain": null,
          "id": 7,
          "company": "~",
          "transformationRuleSet": null,
          "outgoingDdi": null,
          "language": null,
          "proxyUser": "~",
          "status": []
      }
      """
