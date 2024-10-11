Feature: Manage brands
  In order to manage brands
  as a super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a brand
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/brands/2" with body:
    """
      {
        "name": "api_brand_modified",
        "domainUsers": "sip-api.irontec.com",
        "recordingsLimitMB": 0,
        "recordingsLimitEmail": "",
        "invoice": {
          "nif": "1234",
          "postalAddress": "",
          "postalCode": "48960",
          "town": "",
          "province": "",
          "country": "",
          "registryData": ""
        },
        "language": 1,
        "defaultTimezone": 145,
        "features": [2],
        "proxyTrunks": [2],
        "applicationServerSets": [1],
        "mediaRelaySets": [1]
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "name": "api_brand_modified",
          "domainUsers": "sip-api.irontec.com",
          "maxCalls": 0,
          "id": 2,
          "logo": {
              "fileSize": null,
              "mimeType": null,
              "baseName": null
          },
          "invoice": {
              "nif": "1234",
              "postalAddress": "",
              "postalCode": "48960",
              "town": "",
              "province": "",
              "country": "",
              "registryData": ""
          },
          "language": 1,
          "defaultTimezone": 145,
          "currency": 2,
          "voicemailNotificationTemplate": null,
          "faxNotificationTemplate": null,
          "invoiceNotificationTemplate": null,
          "callCsvNotificationTemplate": null,
          "maxDailyUsageNotificationTemplate": null,
          "features": [
              2
          ],
          "proxyTrunks": [
              2
          ],
          "applicationServerSets": [
              1
          ],
          "mediaRelaySets": [
              1
          ]
      }
    """

  @createSchema
  Scenario: Update brand logo
   Given I add Authorization header
    When I add "Content-Type" header equal to "multipart/form-data; boundary=----IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
     And I add "Accept" header equal to "application/json"
     And I send a "PUT" multipart request to "/brands/2" with body:
    """
----IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="brand"

      {}
----IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="Logo"; filename="uploadable"
Content-Type: text/plain

This is file content
----IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be like:
    """
      {
          "name": "Irontec_e2e",
          "domainUsers": "sip.irontec.com",
          "maxCalls": 0,
          "id": 2,
          "logo": {
              "fileSize": 20,
              "mimeType": "text/plain; charset=us-ascii",
              "baseName": "uploadable"
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
          "currency": 2,
          "features": []
      }
    """

  Scenario: Retrieve uploaded brand logo
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "/brands/2/logo"
     Then the response status code should be 200
      And the header "Content-Type" should be equal to "text/plain; charset=us-ascii"

  @createSchema
  Scenario: Update a brand with empty application server sets
    Given I add Authorization header
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "PUT" request to "/brands/2" with body:
    """
      {
        "applicationServerSets": []
      }
    """
    Then the response status code should be 403
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/problem+json; charset=utf-8"
    And the JSON should be like:
    """
    {
      "detail": "Brand cannot be left without a corresponding Application Server Sets"
    }
    """

  @createSchema
  Scenario: Update a brand with empty application server sets
    Given I add Authorization header
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "PUT" request to "/brands/2" with body:
    """
    {
      "mediaRelaySets": []
    }
    """
    Then the response status code should be 403
    And the header "Content-Type" should be equal to "application/problem+json; charset=utf-8"
    And the JSON should be like:
    """
    {
      "detail": "Brand cannot be left without a corresponding Media Relay Set"
    }
    """