Feature: Retrieve friends status
  In order to manage friends status
  As a brand admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the friends status json list
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "friends"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "name": "InterCompany1_3",
              "description": "",
              "priority": 2,
              "directConnectivity": "intervpbx",
              "id": 3,
              "company": 1,
              "domain": 3,
              "interCompany": 3,
              "proxyUser": null
          },
          {
              "name": "testFriend",
              "description": "",
              "priority": 1,
              "directConnectivity": "yes",
              "id": 1,
              "company": 1,
              "domain": 3,
              "interCompany": null,
              "proxyUser": 1
          },
          {
              "name": "InterCompany1_3",
              "description": "",
              "priority": 2,
              "directConnectivity": "intervpbx",
              "id": 2,
              "company": 3,
              "domain": 6,
              "interCompany": 1,
              "proxyUser": null
          }
      ]
      """

  Scenario: Retrieve a friend entity
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "friends/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "name": "testFriend",
          "description": "",
          "transport": "udp",
          "ip": "1.2.3.4",
          "port": 5060,
          "password": "SDG3qd2j6+",
          "priority": 1,
          "directConnectivity": "yes",
          "ruriDomain": null,
          "id": 1,
          "company": {
              "type": "vpbx",
              "name": "DemoCompany",
              "domainUsers": "127.0.0.1",
              "maxCalls": 0,
              "maxDailyUsage": 2,
              "currentDayUsage": 1,
              "maxDailyUsageEmail": "no-replay@domain.net",
              "ipfilter": false,
              "onDemandRecord": 0,
              "allowRecordingRemoval": true,
              "onDemandRecordCode": "",
              "externallyextraopts": "",
              "billingMethod": "prepaid",
              "balance": 1.2,
              "showInvoices": true,
              "id": 1,
              "invoicing": {
                  "nif": "12345678A",
                  "postalAddress": "Company Address",
                  "postalCode": "54321",
                  "town": "Company Town",
                  "province": "Company Province",
                  "countryName": "Company Country"
              },
              "language": 1,
              "defaultTimezone": 145,
              "country": 68,
              "currency": null,
              "transformationRuleSet": 1,
              "outgoingDdi": null,
              "outgoingDdiRule": null,
              "voicemailNotificationTemplate": 1,
              "faxNotificationTemplate": null,
              "invoiceNotificationTemplate": null,
              "callCsvNotificationTemplate": null,
              "maxDailyUsageNotificationTemplate": 2,
              "accessCredentialNotificationTemplate": 5,
              "corporation": 1,
              "applicationServerSet": 1,
              "mediaRelaySet": 0,
              "location": 1
          },
          "interCompany": null,
          "proxyUser": {
              "name": "proxyusers",
              "ip": "127.0.0.1",
              "advertisedIp": "138.0.0.1",
              "id": 1
          }
      }
      """
