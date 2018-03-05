Feature: Create conditional routes
  In order to manage conditional routes
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create an conditional routes
    Given I add Authorization header
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "POST" request to "/conditional_routes" with body:
    """
      {
          "name": "testPost",
          "routetype": "user",
          "numbervalue": "",
          "friendvalue": "",
          "id": 1,
          "company": 1,
          "ivr": null,
          "huntGroup": null,
          "voicemailUser": null,
          "user": 2,
          "queue": null,
          "locution": null,
          "conferenceRoom": null,
          "extension": null,
          "numberCountry": null
      }
    """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
          "name": "testPost",
          "routetype": "user",
          "id": 3
      }
    """

  Scenario: Retrieve created conditional routes
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "conditional_routes/3"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
       {
          "name": "testPost",
          "routetype": "user",
          "numbervalue": null,
          "friendvalue": null,
          "id": 3,
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
          "ivr": null,
          "huntGroup": null,
          "voicemailUser": null,
          "user": {
              "name": "Bob",
              "lastname": "Bobson",
              "email": "bob@democompany.com",
              "pass": "*****",
              "doNotDisturb": false,
              "isBoss": false,
              "active": true,
              "maxCalls": 1,
              "externalIpCalls": "0",
              "voicemailEnabled": true,
              "voicemailSendMail": true,
              "voicemailAttachSound": true,
              "tokenKey": "ec6a6536ca304edf844d1d248a4f08dc",
              "gsQRCode": false,
              "id": 2,
              "company": 1,
              "callAcl": null,
              "bossAssistant": null,
              "bossAssistantWhiteList": null,
              "transformationRuleSet": 1,
              "language": null,
              "terminal": 2,
              "extension": null,
              "timezone": 1,
              "outgoingDdi": null,
              "outgoingDdiRule": null,
              "voicemailLocution": null
          },
          "queue": null,
          "locution": null,
          "conferenceRoom": null,
          "extension": null,
          "numberCountry": null
      }
    """
