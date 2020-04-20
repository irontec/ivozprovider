Feature: Create proxy trunks rel brands
  In order to manage proxy trunks rel brands
  as a super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a proxy trunk rel brand
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/proxy_trunks_rel_brands" with body:
    """
        {
            "brand": 2,
            "proxyTrunk": 2
        }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "id": 2,
          "brand": 2,
          "proxyTrunk": 2
      }
    """

  Scenario: Retrieve created proxy trunk rel brand
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "proxy_trunks_rel_brands/2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
          "id": 2,
          "brand": {
              "name": "Irontec_e2e",
              "domainUsers": "sip.irontec.com",
              "maxCalls": 0,
              "id": 2,
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
              "defaultTimezone": 145
          },
          "proxyTrunk": {
              "name": "ExtraIP",
              "ip": "127.0.0.3",
              "id": 2
          }
      }
    """
