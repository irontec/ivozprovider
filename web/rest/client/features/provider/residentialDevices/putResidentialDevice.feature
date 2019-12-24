Feature: Update residential devices
  In order to manage residential devices
  As a client admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a residential device
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/residential_devices/1" with body:
    """
      {
          "name": "updatedResidentialDevice",
          "description": "",
          "transport": "udp",
          "ip": null,
          "port": null,
          "authNeeded": "yes",
          "password": "ZGthe7E2+4",
          "disallow": "all",
          "allow": "alaw",
          "directMediaMethod": "invite",
          "calleridUpdateHeader": "pai",
          "updateCallerid": "yes",
          "fromDomain": null,
          "directConnectivity": "yes",
          "outgoingDdi": 1,
          "language": 1
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be like:
    """
      {
          "name": "updatedResidentialDevice",
          "description": "",
          "transport": "udp",
          "password": "ZGthe7E2+4",
          "id": 1,
          "outgoingDdi": {
              "ddi": "123",
              "recordCalls": "none",
              "displayName": "",
              "routeType": null,
              "friendValue": "",
              "id": 1,
              "conferenceRoom": null,
              "language": null,
              "queue": null,
              "externalCallFilter": null,
              "user": null,
              "ivr": null,
              "huntGroup": null,
              "fax": null,
              "country": 68,
              "residentialDevice": null,
              "conditionalRoute": null,
              "retailAccount": null
          },
          "language": {
              "iden": "es",
              "id": 1,
              "name": {
                  "en": "es",
                  "es": "es",
                  "ca": "es"
              }
          }
      }
    """
