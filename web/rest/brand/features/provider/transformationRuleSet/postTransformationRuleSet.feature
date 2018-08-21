Feature: Create transformation rule sets
  In order to manage transformation rule sets
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a transformation rule set
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/transformation_rule_sets" with body:
    """
      {
          "description": "New transformation for Usansolocity",
          "internationalCode": "00",
          "trunkPrefix": "",
          "areaCode": "",
          "nationalLen": 9,
          "generateRules": false,
          "name": {
              "en": "usansolocity",
              "es": "usansolo"
          },
          "country": 2
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "description": "New transformation for Usansolocity",
          "internationalCode": "00",
          "trunkPrefix": "",
          "areaCode": "",
          "nationalLen": 9,
          "id": 3
      }
    """

  Scenario: Retrieve created transformation rule set
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "transformation_rule_sets/3"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
          "description": "New transformation for Usansolocity",
          "internationalCode": "00",
          "trunkPrefix": "",
          "areaCode": "",
          "nationalLen": 9,
          "generateRules": false,
          "id": 3,
          "name": {
              "en": "usansolocity",
              "es": "usansolo"
          },
          "brand": null,
          "country": {
              "code": "GB",
              "countryCode": "+44",
              "id": 2,
              "name": {
                  "en": "United Kingdom",
                  "es": "Reino Unido"
              },
              "zone": {
                  "en": "Europe",
                  "es": "Europa"
              }
          }
      }
    """
