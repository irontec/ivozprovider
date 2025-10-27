Feature: Update residential devices
  In order to manage residential devices
  As a client admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a residential device
    Given I add Residential Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/residential_devices/1" with body:
      """
      {
          "name": "readOnlyResidentialDevice",
          "description": "som desc",
          "transport": "udp",
          "ip": "127.10.10.10",
          "port": "1024",
          "password": "ZGthe7E2+4",
          "disallow": "all",
          "allow": "alaw",
          "directMediaMethod": "invite",
          "calleridUpdateHeader": "pai",
          "updateCallerid": "yes",
          "fromDomain": null,
          "directConnectivity": "yes",
          "outgoingDdi": 2,
          "language": 1
      }
      """
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "name": "residentialDevice",
          "description": "som desc",
          "transport": "udp",
          "ip": null,
          "port": null,
          "password": "ZGthe7E2+4",
          "allow": "alaw",
          "fromDomain": null,
          "directConnectivity": "no",
          "ddiIn": "yes",
          "maxCalls": 1,
          "t38Passthrough": "no",
          "rtpEncryption": false,
          "multiContact": true,
          "ruriDomain": null,
          "trustSDP": false,
          "id": 1,
          "transformationRuleSet": null,
          "outgoingDdi": 2,
          "language": 1
      }
      """

  @createSchema
  Scenario: Update a residential device
    Given I add Residential Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/residential_devices/1" with body:
      """
      {
          "directConnectivity": "no",
          "ruriDomain": "test.example.com"
      }
      """
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "name": "residentialDevice",
          "description": "",
          "transport": "udp",
          "ip": null,
          "port": null,
          "password": "+rA778LidL",
          "allow": "alaw",
          "fromDomain": null,
          "directConnectivity": "no",
          "ddiIn": "yes",
          "maxCalls": 1,
          "t38Passthrough": "no",
          "rtpEncryption": false,
          "multiContact": true,
          "ruriDomain": null,
          "trustSDP": false,
          "id": 1,
          "transformationRuleSet": null,
          "outgoingDdi": null,
          "language": null
      }
      """

  @createSchema
  Scenario: Update a residential device with invalid values
    Given I add Residential Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/residential_devices/6" with body:
      """
      {
          "directConnectivity": "yes",
          "ip": null,
          "port": null,
          "ruriDomain": null
      }
      """
     Then the response status code should be 400

  @createSchema
  Scenario: Update a residential device with ruriDomain
    Given I add Residential Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/residential_devices/6" with body:
      """
      {
          "directConnectivity": "yes",
          "ip": null,
          "port": null,
          "ruriDomain": "test.example.com"
      }
      """
     Then the response status code should be 200
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "id": 6,
          "directConnectivity": "yes",
          "ip": null,
          "port": null,
          "ruriDomain": "test.example.com"
      }
      """

  @createSchema
  Scenario: Update a residential device with ip+port
    Given I add Residential Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/residential_devices/6" with body:
      """
      {
        "directConnectivity": "yes",
        "ip": "10.10.10.10",
        "port": "1010",
        "ruriDomain": null
      }
      """
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
        "id": 6,
        "directConnectivity": "yes",
        "ip": "10.10.10.10",
        "port": 1010,
        "ruriDomain": null
      }
      """

  @createSchema
  Scenario: Update a residential device directConnectivity
    Given I add Residential Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/residential_devices/1" with body:
      """
      {
        "directConnectivity": "yes"
      }
      """
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
        "directConnectivity": "no"
      }
      """

  @createSchema
  Scenario: Update a residential device with ruriDomain and port without IP
    Given I add Residential Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/residential_devices/6" with body:
      """
      {
        "directConnectivity": "yes",
        "ip": null,
        "port": "5070",
        "ruriDomain": "proxy.example.com"
      }
      """
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
        "id": 6,
        "directConnectivity": "yes",
        "ip": null,
        "port": 5070,
        "ruriDomain": "proxy.example.com"
      }
      """
