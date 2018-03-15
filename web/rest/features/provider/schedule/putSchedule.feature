Feature: Update schedules
  In order to manage schedules
  As an super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a schedule
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/schedules/1" with body:
    """
      {
          "name": "updatedSchedule",
          "timeIn": "1971-01-01 08:00:00",
          "timeout": "1970-01-31 16:00:01",
          "monday": false,
          "tuesday": true,
          "wednesday": true,
          "thursday": true,
          "friday": true,
          "saturday": false,
          "sunday": false,
          "company": 2
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "name": "updatedSchedule",
          "timeIn": "1971-01-01 08:00:00",
          "timeout": "1970-01-31 16:00:01",
          "monday": false,
          "tuesday": true,
          "wednesday": true,
          "thursday": true,
          "friday": true,
          "saturday": false,
          "sunday": false,
          "id": 1,
          "company": {
              "type": "vpbx",
              "name": "Irontec Test Company",
              "domainUsers": "test.irontec.com",
              "nif": "12345678-Z",
              "distributeMethod": "hash",
              "maxCalls": 0,
              "postalAddress": "Postal address",
              "postalCode": "PC",
              "town": "Town",
              "province": "Province",
              "countryName": "Country",
              "ipfilter": true,
              "onDemandRecord": 0,
              "onDemandRecordCode": "",
              "externallyextraopts": null,
              "recordingsLimitMB": null,
              "recordingsLimitEmail": null,
              "id": 2,
              "language": 1,
              "mediaRelaySets": 1,
              "defaultTimezone": 1,
              "brand": 1,
              "domain": 5,
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
