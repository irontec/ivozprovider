Feature: Update residential devices
  In order to manage residential devices
  As a client admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a residential device
    Given I add Residential Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/residential_devices/1" with body:
    """
      {
          "name": "readOnlyResidentialDevice",
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
          "outgoingDdi": 2,
          "language": 1
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be like:
    """
      {
          "name": "residentialDevice",
          "description": "",
          "transport": "udp",
          "password": "ZGthe7E2+4",
          "id": 1,
          "outgoingDdi": 2,
          "language": 1
      }
    """
