Feature: Update music on holds
  In order to manage music on holds
  As an super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a music on hold
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/music_on_holds/1" with body:
    """
      {
          "name": "Something updated",
          "status": null,
          "originalFile": {
              "fileSize": null,
              "mimeType": null,
              "baseName": null
          },
          "encodedFile": {
              "fileSize": null,
              "mimeType": null,
              "baseName": null
          },
          "brand": null,
          "company": 1
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
     {
          "name": "Something updated",
          "status": null,
          "id": 1,
          "originalFile": {
              "fileSize": null,
              "mimeType": null,
              "baseName": null
          },
          "encodedFile": {
              "fileSize": null,
              "mimeType": null,
              "baseName": null
          },
          "brand": null,
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
              "billingMethod": "prepaid",
              "balance": 1.2,
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
              "faxNotificationTemplate": null,
              "invoiceNotificationTemplate": null
          }
      }
    """
