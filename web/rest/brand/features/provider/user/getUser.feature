Feature: Retrieve users
  In order to manage users
  As a brand admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the user json list
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "users"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      [
          {
              "name": "Alice",
              "lastname": "Allison",
              "email": "alice@democompany.com",
              "id": 1,
              "company": 1,
              "terminal": 1,
              "extension": null,
              "outgoingDdi": null,
              "location": null,
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
              "name": "Bob",
              "lastname": "Bobson",
              "email": "bob@democompany.com",
              "id": 2,
              "company": 1,
              "terminal": 2,
              "extension": null,
              "outgoingDdi": null,
              "location": 1,
              "status": []
          }
      ]
    """

  Scenario: Retrieve certain user json
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "users/1"
     Then the response status code should be 404
