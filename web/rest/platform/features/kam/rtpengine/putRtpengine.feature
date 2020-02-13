Feature: Update rtpengines
  In order to manage rtpengines
  as a super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update an rtpengines
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/rtpengines/1" with body:
    """
      {
          "setid": 1,
          "url": "udp:127.0.0.1:22222",
          "weight": 3,
          "disabled": true,
          "stamp": "2020-01-01 01:00:00",
          "description": "rtpengine01-updated",
          "mediaRelaySet": 1
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "setid": 1,
          "url": "udp:127.0.0.1:22222",
          "weight": 3,
          "disabled": true,
          "stamp": "2020-01-01 01:00:00",
          "description": "rtpengine01-updated",
          "id": 1,
          "mediaRelaySet": {
              "name": "Test",
              "description": "Test media relay set",
              "id": 1
          }
      }
    """
