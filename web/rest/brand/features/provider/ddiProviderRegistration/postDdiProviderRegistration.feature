Feature: Create ddi provider registrations
  In order to manage ddi provider registrations
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a ddi provider registrations
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/ddi_provider_registrations" with body:
    """
      {
        "username": "NewDDIRegistrationUsername",
        "domain": "NewDDIRegistrationDomain",
        "realm": "NewDDIRegistrationRealm",
        "authUsername": "NewDDIRegistrationAuthUsername",
        "authPassword": "NewDDIRegistrationAuthPassword",
        "authProxy": "sip:NewDDIRegistrationAuthProxy",
        "expires": 3600,
        "multiDdi": true,
        "contactUsername": "",
        "ddiProvider": 1
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "id": 2
      }
    """

  Scenario: Retrieve created ddi provider address
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "/ddi_provider_registrations/2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "username": "NewDDIRegistrationUsername",
          "domain": "NewDDIRegistrationDomain",
          "realm": "NewDDIRegistrationRealm",
          "authUsername": "NewDDIRegistrationAuthUsername",
          "authPassword": "NewDDIRegistrationAuthPassword",
          "authProxy": "sip:NewDDIRegistrationAuthProxy",
          "expires": 3600,
          "multiDdi": true,
          "contactUsername": "",
          "id": 2,
          "ddiProvider": {
              "description": "DDIProviderDescription",
              "name": "DDIProviderName",
              "id": 1,
              "brand": 1,
              "transformationRuleSet": 1
          }
      }
    """
