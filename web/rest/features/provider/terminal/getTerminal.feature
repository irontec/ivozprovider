Feature: Retrieve terminals
  In order to manage terminals
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the terminals json list
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "terminals"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
          {
              "name": "alice",
              "mac": "",
              "lastProvisionDate": null,
              "id": 1
          },
          {
              "name": "bob",
              "mac": "",
              "lastProvisionDate": null,
              "id": 2
          },
          {
              "name": "testTerminal",
              "mac": "0011223344aa",
              "lastProvisionDate": null,
              "id": 3
          }
      ]
    """

  Scenario: Retrieve certain terminals json
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "terminals/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
          "name": "alice",
          "disallow": "all",
          "allowAudio": "alaw",
          "allowVideo": null,
          "directMediaMethod": "invite",
          "password": "****",
          "mac": "",
          "lastProvisionDate": null,
          "id": 1,
          "company": {
              "type": "vpbx",
              "name": "DemoCompany",
              "domainUsers": "127.0.0.1",
              "nif": "12345678A",
              "distributeMethod": "hash",
              "externalMaxCalls": 0,
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
              "outgoingDdiRule": null
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
