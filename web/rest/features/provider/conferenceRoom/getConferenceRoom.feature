Feature: Retrieve conference rooms
  In order to manage conference rooms
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the conference rooms json list
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "conference_rooms"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      [
          {
              "name": "testConferenceRoom",
              "pinProtected": true,
              "maxMembers": 1,
              "id": 1
          }
      ]
    """

  Scenario: Retrieve certain conference room json
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "conference_rooms/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
          "name": "testConferenceRoom",
          "pinProtected": true,
          "pinCode": "4321",
          "maxMembers": 1,
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
          }
      }
    """
