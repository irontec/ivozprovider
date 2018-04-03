Feature: Retrieve recordings
  In order to manage recordings
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the recordings json list
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "recordings"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
          {
              "callid": "7602fd7f-4153-4475-9100-d89ff70cdf76",
              "calldate": "2017-01-05 00:15:15",
              "type": "ondemand",
              "duration": 3,
              "caller": "34946002020",
              "callee": "34946002021",
              "id": 1
          }
      ]
    """

  Scenario: Retrieve certain recording json
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "recordings/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
          "callid": "7602fd7f-4153-4475-9100-d89ff70cdf76",
          "calldate": "2017-01-05 00:15:15",
          "type": "ondemand",
          "duration": 3,
          "caller": "34946002020",
          "callee": "34946002021",
          "recorder": null,
          "id": 1,
          "recordedFile": {
              "fileSize": 4280,
              "mimeType": "audio/mpeg; charset=binary",
              "baseName": "7602fd7f-4153-4475-9100-d89ff70cdf76.0.mp3"
          },
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
