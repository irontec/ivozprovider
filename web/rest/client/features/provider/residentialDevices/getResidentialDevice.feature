Feature: Retrieve residential devices
  In order to manage residential devices
  As a client admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the residential devices json list
    Given I add Residential Company Authorization header
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
              "description": "",
              "directConnectivity": "no",
              "id": 1,
              "domain": 6,
              "status": [
                  {
                      "contact": "sip:yealinktest@10.10.1.108:5060",
                      "received": "sip:212.64.172.25:5060",
                      "publicReceived": true,
                      "expires": "2031-01-01 00:59:59",
                      "userAgent": "Yealink SIP-T23G 44.80.0.130"
                  },
                  {
                      "contact": "sip:yealinktest@10.10.1.110:5060",
                      "received": "",
                      "publicReceived": false,
                      "expires": "2031-01-01 00:59:59",
                      "userAgent": "Yealink SIP-T23G 44.80.0.130"
                  }
              ]
          },
          {
              "name": "residentialDevice6",
              "description": "",
              "directConnectivity": "yes",
              "id": 6,
              "domain": 6,
              "status": []
          }
      ]
      """

  Scenario: Retrieve certain residential device json
    Given I add Residential Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "residential_devices/1"
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
          "language": null,
          "status": [
              {
                  "contact": "sip:yealinktest@10.10.1.108:5060",
                  "received": "sip:212.64.172.25:5060",
                  "publicReceived": true,
                  "expires": "2031-01-01 00:59:59",
                  "userAgent": "Yealink SIP-T23G 44.80.0.130"
              },
              {
                  "contact": "sip:yealinktest@10.10.1.110:5060",
                  "received": "",
                  "publicReceived": false,
                  "expires": "2031-01-01 00:59:59",
                  "userAgent": "Yealink SIP-T23G 44.80.0.130"
              }
          ]
      }
      """
