Feature: Create rtpengines
  In order to manage rtpengines
  as a super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create an rtpengines
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/rtpengines" with body:
      """
      {
          "setid": 99999999,
          "url": "udp:127.0.0.2:2223",
          "weight": 2,
          "disabled": false,
          "stamp": "2000-01-01 01:00:00",
          "description": "rtpengine02",
          "mediaRelaySet": 1
      }
      """
     Then the response status code should be 201
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "setid": 1,
          "url": "udp:127.0.0.2:2223",
          "weight": 2,
          "disabled": false,
          "stamp": "2000-01-01 01:00:00",
          "description": "rtpengine02",
          "id": 2,
          "mediaRelaySet": 1
      }
      """

  Scenario: Retrieve created rtpengine
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "rtpengines/2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "setid": 1,
          "url": "udp:127.0.0.2:2223",
          "weight": 2,
          "disabled": false,
          "stamp": "2000-01-01 01:00:00",
          "description": "rtpengine02",
          "id": 2,
          "mediaRelaySet": {
              "name": "Test",
              "description": "Test media relay set",
              "id": 1
          }
      }
      """
