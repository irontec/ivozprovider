Feature: Update ddi provider registrations
  In order to manage ddi provider registrations
  As an super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a ddi provider address
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/ddi_provider_registrations/1" with body:
    """
      {
        "username": "UpdatedDDIRegistrationUsername",
        "domain": "UpdatedDDIRegistrationDomain",
        "realm": "UpdatedDDIRegistrationRealm",
        "authUsername": "UpdatedDDIRegistrationAuthUsername",
        "authPassword": "UpdatedDDIRegistrationAuthPassword",
        "authProxy": "sip:UpdatedDDIRegistrationAuthProxy",
        "expires": 3600,
        "multiDdi": true,
        "contactUsername": "",
        "ddiProvider": 1
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "username": "UpdatedDDIRegistrationUsername",
          "domain": "UpdatedDDIRegistrationDomain",
          "realm": "UpdatedDDIRegistrationRealm",
          "authUsername": "UpdatedDDIRegistrationAuthUsername",
          "authPassword": "UpdatedDDIRegistrationAuthPassword",
          "authProxy": "sip:UpdatedDDIRegistrationAuthProxy",
          "expires": 3600,
          "multiDdi": true,
          "contactUsername": "",
          "id": 1,
          "ddiProvider": {
              "description": "DDIProviderDescription",
              "name": "DDIProviderName",
              "externallyRated": false,
              "id": 1,
              "brand": 1,
              "transformationRuleSet": 1
          }
      }
    """
