Feature: Create friends
  In order to manage friends
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create an friends
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/friends" with body:
    """
      {
          "name": "beWatterMyFriend",
          "description": "something",
          "transport": "tls",
          "ip": "129.1.2.3",
          "port": "5060",
          "authNeeded": "yes",
          "password": "ZEF7t5n+b4",
          "priority": 2,
          "disallow": "all",
          "allow": "alaw",
          "directMediaMethod": "update",
          "calleridUpdateHeader": "pai",
          "updateCallerid": "yes",
          "fromDomain": "",
          "directConnectivity": "yes",
          "company": 1,
          "domain": 1,
          "transformationRuleSet": null,
          "callAcl": null,
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
          "name": "beWatterMyFriend",
          "id": 2
      }
    """

  Scenario: Retrieve created friends
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "friends/2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
          "name": "beWatterMyFriend",
          "description": "something",
          "transport": "tls",
          "ip": "129.1.2.3",
          "port": 5060,
          "authNeeded": "yes",
          "password": "****",
          "priority": 2,
          "disallow": "all",
          "allow": "alaw",
          "directMediaMethod": "update",
          "calleridUpdateHeader": "pai",
          "updateCallerid": "yes",
          "fromDomain": "",
          "directConnectivity": "yes",
          "id": 2,
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
          "domain": {
              "domain": "127.0.0.1",
              "pointsTo": "proxyusers",
              "description": "DemoCompany proxyusers domain",
              "id": 3
          },
          "transformationRuleSet": null,
          "callAcl": null,
          "outgoingDdi": null,
          "language": null
      }
    """
