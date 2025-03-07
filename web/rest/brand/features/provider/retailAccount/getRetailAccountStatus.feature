Feature: Retrieve retail accounts status
  In order to manage retail accounts status
  As a brand admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the retail accounts status json list
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "retail_accounts/status"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
           {
              "name": "testRetailAccount2",
              "description": "",
              "directConnectivity": "no",
              "rtpEncryption": false,
              "multiContact": true,
              "id": 2,
              "company": 1,
              "domainName": "retail.irontec.com",
              "status": []
          },
          {
              "name": "testRetailAccount3",
              "description": "",
              "directConnectivity": "no",
              "rtpEncryption": false,
              "multiContact": true,
              "id": 3,
              "company": 1,
              "domainName": "retail.irontec.com",
              "status": []
          },
          {
              "name": "testRetailAccount4",
              "description": "",
              "directConnectivity": "no",
              "rtpEncryption": false,
              "multiContact": true,
              "id": 4,
              "company": 1,
              "domainName": "retail.irontec.com",
              "status": []
          },
          {
              "name": "testRetailAccount5",
              "description": "",
              "directConnectivity": "no",
              "rtpEncryption": false,
              "multiContact": true,
              "id": 5,
              "company": 1,
              "domainName": "retail.irontec.com",
              "status": []
          },
          {
              "name": "testRetailAccount",
              "description": "",
              "directConnectivity": "no",
              "rtpEncryption": false,
              "multiContact": true,
              "id": 1,
              "company": 3,
              "domainName": "retail.irontec.com",
              "status": [
                  {
                      "contact": "sip:yealinktest@10.10.1.109:5060",
                      "publicContact": false,
                      "received": "sip:212.64.172.26:5060",
                      "publicReceived": true,
                      "expires": "2031-01-01 00:59:59",
                      "userAgent": "Yealink SIP-T23G 44.80.0.130"
                  }
              ]
          },
          {
              "name": "testRetailAccount6",
              "description": "",
              "directConnectivity": "yes",
              "rtpEncryption": false,
              "multiContact": true,
              "id": 6,
              "company": 3,
              "domainName": "retail.irontec.com",
              "status": []
          }
      ]
      """
