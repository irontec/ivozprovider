Feature: Retrieve call acls
  In order to manage call acls
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the call acl json list
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "call_acls"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      [
          {
              "name": "testACL",
              "defaultPolicy": "allow",
              "id": 1
          },
          {
              "name": "testACL2",
              "defaultPolicy": "deny",
              "id": 2
          }
      ]
    """

  Scenario: Retrieve certain call acl json
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "call_acls/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
          "name": "testACL",
          "defaultPolicy": "allow",
          "id": 1,
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
              "balance": "1.2",
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
          }
      }
    """
