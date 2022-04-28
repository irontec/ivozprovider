Feature: Retrieve terminals
  In order to manage terminals
  As a client admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the terminals json list
    Given I add Company Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "terminals"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
          {
              "name": "alice",
              "mac": null,
              "lastProvisionDate": null,
              "id": 1,
              "domain": 3,
              "terminalModel": 1,
              "domainName": "127.0.0.1",
              "status": [
                  {
                      "contact": "sip:yealinktest@10.10.1.106:5060",
                      "received": "sip:212.64.172.23:5060",
                      "publicReceived": true,
                      "expires": "2031-01-01 00:59:59",
                      "userAgent": "Yealink SIP-T23G 44.80.0.130"
                  }
              ]
          },
          {
              "name": "bob",
              "mac": null,
              "lastProvisionDate": null,
              "id": 2,
              "domain": 3,
              "terminalModel": 1,
              "domainName": "127.0.0.1",
              "status": []
          },
          {
              "name": "testTerminal",
              "mac": "0011223344aa",
              "lastProvisionDate": null,
              "id": 3,
              "domain": 3,
              "terminalModel": 1,
              "domainName": "127.0.0.1",
              "status": []
          }
      ]
    """

  Scenario: Retrieve certain terminals json
    Given I add Company Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "terminals/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
          "name": "alice",
          "disallow": "all",
          "allowAudio": "alaw",
          "allowVideo": null,
          "directMediaMethod": "invite",
          "password": "AUfVkn498_",
          "mac": null,
          "lastProvisionDate": null,
          "t38Passthrough": "no",
          "rtpEncryption": false,
          "id": 1,
          "terminalModel": {
              "iden": "Generic",
              "name": "Generic SIP Model",
              "description": "Generic SIP Model",
              "id": 1
          },
          "status": [
              {
                  "contact": "sip:yealinktest@10.10.1.106:5060",
                  "received": "sip:212.64.172.23:5060",
                  "publicReceived": true,
                  "expires": "2031-01-01 00:59:59",
                  "userAgent": "Yealink SIP-T23G 44.80.0.130"
              }
          ]
      }
    """
