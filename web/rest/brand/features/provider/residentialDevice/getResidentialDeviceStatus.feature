Feature: Retrieve residential devices status
  In order to manage residential devices status
  As a brand admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the residential devices status json list
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "residential_devices/status"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "name": "residentialDevice2",
              "directConnectivity": "no",
              "id": 2,
              "company": 1,
              "domainName": "retail.irontec.com",
              "status": []
          },
          {
              "name": "residentialDevice3",
              "directConnectivity": "no",
              "id": 3,
              "company": 1,
              "domainName": "retail.irontec.com",
              "status": []
          },
          {
              "name": "residentialDevice4",
              "directConnectivity": "no",
              "id": 4,
              "company": 1,
              "domainName": "retail.irontec.com",
              "status": []
          },
          {
              "name": "residentialDevice5",
              "directConnectivity": "no",
              "id": 5,
              "company": 1,
              "domainName": "retail.irontec.com",
              "status": []
          },
          {
              "name": "residentialDevice",
              "directConnectivity": "no",
              "id": 1,
              "company": 4,
              "domainName": "retail.irontec.com",
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
              "directConnectivity": "yes",
              "id": 6,
              "company": 4,
              "domainName": "retail.irontec.com",
              "status": []
          }
      ]
      """
