Feature: Retrieve status
  In order to manage status
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema @userApiContext
  Scenario: Retrieve the status json list
    Given I add User Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "my/status"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
          "userName": "Alice Allison",
          "companyName": "DemoCompany",
          "companyDomain": "127.0.0.1",
          "language": "es",
          "voiceMail": "93",
          "gsQRCode": false,
          "userAgent": null,
          "ipRegistered": null,
          "statusTerminal": null,
          "terminalName": "alice",
          "terminalPassword": "AUfVkn498_",
          "extensionNumber": null
      }
    """
