Feature: Manage brands
  In order to manage brands
  as a super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a brand
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/brands" with body:
    """
      {
        "name": "api_brand",
        "domainUsers": "sip-api.irontec.com",
        "invoice": {
          "nif": "123",
          "postalAddress": "",
          "postalCode": "48971",
          "town": "Bilbo",
          "province": "Bizkaia",
          "country": "Spain",
          "registryData": "registryData"
        },
        "defaultTimezone": 145,
        "language": 1,
        "currency": 1,
        "features": [1,2],
        "proxyTrunks": [1],
        "applicationServerSets": [1],
        "mediaRelaySets": [0]
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "name": "api_brand",
          "domainUsers": "sip-api.irontec.com",
          "maxCalls": 0,
          "id": 3,
          "logo": {
              "fileSize": null,
              "mimeType": null,
              "baseName": null
          },
          "invoice": {
              "nif": "123",
              "postalAddress": "",
              "postalCode": "48971",
              "town": "Bilbo",
              "province": "Bizkaia",
              "country": "Spain",
              "registryData": "registryData"
          },
          "language": {
              "iden": "es",
              "id": 1,
              "name": {
                  "en": "es",
                  "es": "es",
                  "ca": "es",
                  "it": "es"
              }
          },
          "defaultTimezone": {
              "tz": "Europe/Madrid",
              "comment": "mainland",
              "id": 145,
              "label": {
                  "en": "en",
                  "es": "es",
                  "ca": "ca",
                  "it": "it"
              },
              "country": 68
          },
          "currency": {
              "iden": "EUR",
              "symbol": "€",
              "id": 1,
              "name": {
                  "en": "Euro",
                  "es": "Euro",
                  "ca": "Euro",
                  "it": "Euro"
              }
          },
          "voicemailNotificationTemplate": null,
          "faxNotificationTemplate": null,
          "invoiceNotificationTemplate": null,
          "callCsvNotificationTemplate": null,
          "maxDailyUsageNotificationTemplate": null,
          "features": [
              1,
              2
          ],
          "proxyTrunks": [
              1
          ],
          "applicationServerSets": [
              1
          ],
          "mediaRelaySets": [
              0
          ]
      }
    """

  Scenario: Retrieve created brand
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "brands/3"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
          "name": "api_brand",
          "domainUsers": "sip-api.irontec.com",
          "maxCalls": 0,
          "id": 3,
          "logo": {
              "fileSize": null,
              "mimeType": null,
              "baseName": null
          },
          "invoice": {
              "nif": "123",
              "postalAddress": "",
              "postalCode": "48971",
              "town": "Bilbo",
              "province": "Bizkaia",
              "country": "Spain",
              "registryData": "registryData"
          },
          "language": {
              "iden": "es",
              "id": 1,
              "name": {
                  "en": "es",
                  "es": "es",
                  "ca": "es",
                  "it": "es"
              }
          },
          "defaultTimezone": {
              "tz": "Europe/Madrid",
              "comment": "mainland",
              "id": 145,
              "label": {
                  "en": "en",
                  "es": "es",
                  "ca": "ca",
                  "it": "it"
              },
              "country": 68
          },
          "currency": {
              "iden": "EUR",
              "symbol": "€",
              "id": 1,
              "name": {
                  "en": "Euro",
                  "es": "Euro",
                  "ca": "Euro",
                  "it": "Euro"
              }
          },
          "voicemailNotificationTemplate": null,
          "faxNotificationTemplate": null,
          "invoiceNotificationTemplate": null,
          "callCsvNotificationTemplate": null,
          "maxDailyUsageNotificationTemplate": null,
          "features": [
              1,
              2
          ],
          "proxyTrunks": [
              1
          ],
          "applicationServerSets": [
              1
          ],
          "mediaRelaySets": [
              0
          ]
      }
    """

  @createSchema
  Scenario: Create a brand with logo
    Given I add Authorization header
    When I add "Content-Type" header equal to "multipart/form-data; boundary=----IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
    And I add "Accept" header equal to "application/json"
    And I send a "POST" multipart request to "/brands" with body:
    """
----IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="brand"

      {
        "name": "api_brand",
        "domainUsers": "sip-api.irontec.com",
        "recordingsLimitMB": 10,
        "recordingsLimitEmail": "mikel@irontec.com",
        "invoice": {
          "nif": "123",
          "postalAddress": "",
          "postalCode": "48971",
          "town": "Bilbo",
          "province": "Bizkaia",
          "country": "Spain",
          "registryData": "registryData"
        },
        "defaultTimezone": 145,
        "language": 1,
        "currency": 1,
        "features": [1],
        "proxyTrunks": [1],
        "applicationServerSets": [1],
        "mediaRelaySets": [0]
      }
----IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="Logo"; filename="uploadable"
Content-Type: text/plain

This is file content
----IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
          "name": "api_brand",
          "domainUsers": "sip-api.irontec.com",
          "maxCalls": 0,
          "id": 3,
          "logo": {
              "fileSize": 20,
              "mimeType": "text/plain; charset=us-ascii",
              "baseName": "uploadable"
          },
          "invoice": {
              "nif": "123",
              "postalAddress": "",
              "postalCode": "48971",
              "town": "Bilbo",
              "province": "Bizkaia",
              "country": "Spain",
              "registryData": "registryData"
          },
          "language": {
              "iden": "es",
              "id": 1,
              "name": {
                  "en": "es",
                  "es": "es",
                  "ca": "es",
                  "it": "es"
              }
          },
          "defaultTimezone": {
              "tz": "Europe/Madrid",
              "comment": "mainland",
              "id": 145,
              "label": {
                  "en": "en",
                  "es": "es",
                  "ca": "ca",
                  "it": "it"
              },
              "country": 68
          },
          "currency": {
              "iden": "EUR",
              "symbol": "€",
              "id": 1,
              "name": {
                  "en": "Euro",
                  "es": "Euro",
                  "ca": "Euro",
                  "it": "Euro"
              }
          },
          "voicemailNotificationTemplate": null,
          "faxNotificationTemplate": null,
          "invoiceNotificationTemplate": null,
          "callCsvNotificationTemplate": null,
          "maxDailyUsageNotificationTemplate": null,
          "features": [
              1
          ],
          "proxyTrunks": [
              1
          ],
          "applicationServerSets": [
              1
          ],
          "mediaRelaySets": [
              0
          ]
      }
    """

  Scenario: Retrieve uploaded brand logo
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "/brands/3/logo"
     Then the response status code should be 200
      And the header "Content-Type" should be equal to "text/plain; charset=us-ascii"

@createSchema
Scenario: Create a brand without applicationServerSets
  Given I add Authorization header
  When I add "Content-Type" header equal to "application/json"
  And I add "Accept" header equal to "application/json"
  And I send a "POST" request to "/brands" with body:
    """
      {
        "name": "api_brand",
        "domainUsers": "sip-api.irontec.com",
        "invoice": {
          "nif": "123",
          "postalAddress": "",
          "postalCode": "48971",
          "town": "Bilbo",
          "province": "Bizkaia",
          "country": "Spain",
          "registryData": "registryData"
        },
        "defaultTimezone": 145,
        "language": 1,
        "currency": 1,
        "features": [1,2],
        "proxyTrunks": [1],
        "mediaServerSets": [0]
      }
    """
  Then the response status code should be 403
  And the response should be in JSON
  And the header "Content-Type" should be equal to "application/problem+json; charset=utf-8"
  And the JSON should be like:
  """
  {
    "detail": "Application Server Sets cannot be empty"
  }
  """

  @createSchema
  Scenario: Create a brand without mediaServerSets
    Given I add Authorization header
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "POST" request to "/brands" with body:
    """
      {
        "name": "api_brand",
        "domainUsers": "sip-api.irontec.com",
        "invoice": {
          "nif": "123",
          "postalAddress": "",
          "postalCode": "48971",
          "town": "Bilbo",
          "province": "Bizkaia",
          "country": "Spain",
          "registryData": "registryData"
        },
        "defaultTimezone": 145,
        "language": 1,
        "currency": 1,
        "features": [1,2],
        "proxyTrunks": [1],
        "applicationServerSets": [1]
      }
    """
    Then the response status code should be 403
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/problem+json; charset=utf-8"
    And the JSON should be like:
    """
    {
      "detail": "Media Relay Sets cannot be empty"
    }
    """