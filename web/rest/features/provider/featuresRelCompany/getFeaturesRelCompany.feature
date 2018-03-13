Feature: Retrieve features rel companies
  In order to manage features rel companies
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the features rel companies json list
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "features_rel_companies"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
          {
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
              "feature": {
                  "iden": "queues",
                  "id": 1,
                  "name": {
                      "en": "en",
                      "es": "es"
                  }
              }
          },
          {
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
                  "outgoingDdiRule": null
              },
              "feature": {
                  "iden": "recordings",
                  "id": 2,
                  "name": {
                      "en": "en",
                      "es": "es"
                  }
              }
          },
          {
              "id": 3,
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
                  "outgoingDdiRule": null
              },
              "feature": {
                  "iden": "faxes",
                  "id": 3,
                  "name": {
                      "en": "en",
                      "es": "es"
                  }
              }
          },
          {
              "id": 4,
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
                  "outgoingDdiRule": null
              },
              "feature": {
                  "iden": "friends",
                  "id": 4,
                  "name": {
                      "en": "en",
                      "es": "es"
                  }
              }
          },
          {
              "id": 5,
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
                  "outgoingDdiRule": null
              },
              "feature": {
                  "iden": "conferences",
                  "id": 5,
                  "name": {
                      "en": "en",
                      "es": "es"
                  }
              }
          }
      ]
    """

  Scenario: Retrieve certain features rel company json
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "features_rel_companies/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
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
          "feature": {
              "iden": "queues",
              "id": 1,
              "name": {
                  "en": "en",
                  "es": "es"
              }
          }
      }
    """
