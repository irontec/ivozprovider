Feature: Update special numbers
  In order to manage special numbers
  as a brand admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a special number
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/special_numbers/2" with body:
    """
        {
            "number": "016",
            "disableCDR": 0,
            "country": 68
        }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "number": "016",
          "disableCDR": 0,
          "id": 2,
          "country": {
              "code": "ES",
              "countryCode": "+34",
              "id": 68,
              "name": {
                  "en": "Spain",
                  "es": "España",
                  "ca": "España",
                  "it": "Spagna"
              },
              "zone": {
                  "en": "Europe",
                  "es": "Europa",
                  "ca": "Europa",
                  "it": "Europe"
              }
          },
          "global": false
      }
    """

  Scenario: Can not update a global special number
    Given I add Brand Authorization header
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "PUT" request to "/special_numbers/1" with body:
    """
        {
            "number": "016",
            "disableCDR": 0,
            "country": 68
        }
    """
    Then the response status code should be 403
