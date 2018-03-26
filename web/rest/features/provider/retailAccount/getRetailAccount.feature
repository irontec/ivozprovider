Feature: Retrieve retail accounts
  In order to manage retail accounts
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the retail accounts json list
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "retail_accounts"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
          {
              "name": "retail",
              "transport": "udp",
              "authNeeded": "yes",
              "id": 1
          }
      ]
    """

  Scenario: Retrieve certain retail account json
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "retail_accounts/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
          "name": "retail",
          "description": "",
          "transport": "udp",
          "ip": null,
          "port": null,
          "authNeeded": "yes",
          "password": "****",
          "disallow": "all",
          "allow": "alaw",
          "directMediaMethod": "invite",
          "calleridUpdateHeader": "pai",
          "updateCallerid": "yes",
          "fromDomain": null,
          "directConnectivity": "yes",
          "id": 1,
          "brand": {
              "name": "DemoBrand",
              "domainUsers": "",
              "recordingsLimitMB": null,
              "recordingsLimitEmail": "",
              "maxCalls": 0,
              "id": 1,
              "logo": {
                  "fileSize": null,
                  "mimeType": null,
                  "baseName": null
              },
              "invoice": {
                  "nif": "",
                  "postalAddress": "",
                  "postalCode": "",
                  "town": "",
                  "province": "",
                  "country": "",
                  "registryData": ""
              },
              "domain": 6,
              "language": 1,
              "defaultTimezone": 1
          },
          "company": {
              "type": "retail",
              "name": "Retail Company",
              "domainUsers": "retail.irontec.com",
              "nif": "12345679-Z",
              "distributeMethod": "hash",
              "maxCalls": 0,
              "postalAddress": "",
              "postalCode": "",
              "town": "",
              "province": "",
              "countryName": "",
              "ipfilter": true,
              "onDemandRecord": 0,
              "onDemandRecordCode": "",
              "externallyextraopts": null,
              "recordingsLimitMB": null,
              "recordingsLimitEmail": null,
              "billingMethod": "postpaid",
              "balance": "0",
              "id": 3,
              "language": 1,
              "mediaRelaySets": 1,
              "defaultTimezone": 1,
              "brand": 1,
              "domain": 6,
              "applicationServer": null,
              "country": 1,
              "transformationRuleSet": 1,
              "outgoingDdi": null,
              "outgoingDdiRule": null,
              "voicemailNotificationTemplate": 1,
              "faxNotificationTemplate": null
          },
          "transformationRuleSet": null,
          "outgoingDdi": null,
          "language": null
      }
    """
