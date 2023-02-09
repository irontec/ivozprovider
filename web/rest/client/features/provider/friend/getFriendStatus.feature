Feature: Retrieve friends status
  In order to manage friends status
  As a client admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the friends status json list
    Given I add Company Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "friends/status"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
          {
              "name": "testFriend",
              "id": 1,
              "domainName": "127.0.0.1",
              "status": [
                  {
                      "contact": "sip:yealinktest@10.10.1.107:5060",
                      "received": "sip:212.64.172.24:5060",
                      "publicReceived": true,
                      "expires": "2031-01-01 00:59:59",
                      "userAgent": "Yealink SIP-T23G 44.80.0.130"
                  }
              ]
          }
      ]
    """

  Scenario: Retrieve certain friend status json
    Given I add Company Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "friends/1/status"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be like:
    """
      {
            "name": "testFriend",
            "id": 1,
            "domainName": "127.0.0.1",
            "status": [
                {
                    "contact": "sip:yealinktest@10.10.1.107:5060",
                    "received": "sip:212.64.172.24:5060",
                    "publicReceived": true,
                    "expires": "2031-01-01 00:59:59",
                    "userAgent": "Yealink SIP-T23G 44.80.0.130"
                }
            ]
        }
    """
