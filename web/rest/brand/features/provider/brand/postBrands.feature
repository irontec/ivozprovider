Feature: Manage brands
  In order to manage brands
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Cannot create brands
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/brands" with body:
    """
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
        "defaultTimezone": 1
      }
    """
    Then the response status code should be 404

