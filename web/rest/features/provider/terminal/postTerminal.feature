Feature: Create terminals
  In order to manage terminals
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a terminal
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/terminals" with body:
    """
      {
          "name": "alice2",
          "disallow": "all",
          "allowAudio": "alaw",
          "allowVideo": null,
          "directMediaMethod": "invite",
          "password": "ZGthe7E2+5",
          "mac": "",
          "lastProvisionDate": "1970-03-04 11:12:13",
          "company": 1,
          "terminalModel": 1
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "name": "alice2",
          "mac": "",
          "lastProvisionDate": "1970-03-04 11:12:13",
          "id": 4
      }
    """

  Scenario: Retrieve created terminal
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "/terminals/4"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
          "name": "alice2",
          "disallow": "all",
          "allowAudio": "alaw",
          "allowVideo": null,
          "directMediaMethod": "invite",
          "password": "****",
          "mac": "",
          "lastProvisionDate": "1970-03-04 11:12:13",
          "id": 4,
          "company": {
              "type": "vpbx",
              "name": "DemoCompany",
              "domainUsers": "127.0.0.1",
              "nif": "12345678A",
              "distributeMethod": "hash",
              "maxCalls": 0,
              "postalAddress": "Company Address",
              "postalCode": "54321",
              "town": "Company Town",
              "province": "Company Province",
              "countryName": "Company Country",
              "ipfilter": false,
              "onDemandRecord": 0,
              "onDemandRecordCode": "",
              "externallyextraopts": "",
              "recordingsLimitMB": null,
              "recordingsLimitEmail": "",
              "id": 1,
              "language": 1,
              "mediaRelaySets": 1,
              "defaultTimezone": 1,
              "brand": 1,
              "domain": 3,
              "applicationServer": null,
              "country": 1,
              "transformationRuleSet": 1,
              "outgoingDdi": null,
              "outgoingDdiRule": null,
              "voicemailNotificationTemplate": 1,
              "faxNotificationTemplate": null
          },
          "terminalModel": {
              "iden": "Generic",
              "name": "Generic SIP Model",
              "description": "Generic SIP Model",
              "genericTemplate": "",
              "specificTemplate": "",
              "genericUrlPattern": "",
              "specificUrlPattern": "",
              "id": 1,
              "terminalManufacturer": 1
          }
      }
    """
