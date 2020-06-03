Feature: Create residential devices
  In order to manage residential devices
  As a client admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a residential device
    Given I add Residential Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/residential_devices" with body:
    """
      {
          "name": "newRetail",
          "description": "",
          "transport": "udp",
          "password": "qR9Y65pxJ+",
          "outgoingDdi": null,
          "language": null
      }
    """
    Then the response status code should be 405
