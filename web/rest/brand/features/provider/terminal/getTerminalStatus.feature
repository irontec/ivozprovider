Feature: Retrieve terminals status
  In order to manage terminals status
  As a brand admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the terminals status json list
    Given I add Brand Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "terminals/status"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
          {
              "name": "alice",
              "id": 1,
              "company": 1,
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
              "id": 2,
              "company": 1,
              "domainName": "127.0.0.1",
              "status": []
          },
          {
              "name": "testTerminal",
              "id": 3,
              "company": 1,
              "domainName": "127.0.0.1",
              "status": []
          }
      ]
    """
