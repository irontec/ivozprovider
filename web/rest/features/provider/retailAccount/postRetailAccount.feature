Feature: Create retail accounts
  In order to manage retail accounts
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a retail account
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/retail_accounts" with body:
    """
      {
          "name": "newRetail",
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
          "brand": 1,
          "company": 3,
          "transformationRuleSet": null,
          "outgoingDdi": null,
          "language": null
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "name": "newRetail",
          "transport": "udp",
          "authNeeded": "yes",
          "id": 2
      }
    """

  Scenario: Retrieve created retail account
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "retail_accounts/2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
          "name": "newRetail",
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
          "id": 2,
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
