Feature: Retrieve rtpengines
  In order to manage rtpengines
  as a super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the rtpengines json list
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "rtpengines"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      [
          {
              "url": "udp:127.0.0.1:22223",
              "weight": 1,
              "disabled": false,
              "description": "rtpengine01",
              "id": 1
          }
      ]
    """

  Scenario: Retrieve certain rtpengine json
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "rtpengines/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
          "setid": 1,
          "url": "udp:127.0.0.1:22223",
          "weight": 1,
          "disabled": false,
          "stamp": "2000-01-01 01:00:00",
          "description": "rtpengine01",
          "id": 1,
          "mediaRelaySet": {
              "name": "Test",
              "description": "Test media relay set",
              "id": 1
          }
      }
    """
