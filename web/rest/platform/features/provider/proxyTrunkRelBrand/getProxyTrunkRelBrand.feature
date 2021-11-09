Feature: Retrieve proxy trunks rel brands
  In order to manage proxy trunks rel brands
  as a super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the proxy trunks rel brands json list
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "proxy_trunks_rel_brands"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
          {
              "id": 1,
              "brand": {
                  "name": "DemoBrand",
                  "domainUsers": "",
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
                  "language": 1,
                  "defaultTimezone": 145,
                  "currency": 1
              },
              "proxyTrunk": {
                  "name": "proxytrunks",
                  "ip": "127.0.0.1",
                  "id": 1
              }
          }
      ]
    """

  Scenario: Retrieve certain proxy trunk rel brand json
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "proxy_trunks_rel_brands/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
          "id": 1,
          "brand": {
              "name": "DemoBrand",
              "domainUsers": "",
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
              "language": 1,
              "defaultTimezone": 145,
              "currency": 1
          },
          "proxyTrunk": {
              "name": "proxytrunks",
              "ip": "127.0.0.1",
              "id": 1
          }
      }
    """
