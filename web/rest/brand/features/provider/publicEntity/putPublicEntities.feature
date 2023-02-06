Feature: Update public entities
  In order to manage public entities
  as a super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update an public entities
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/public_entities/80" with body:
      """
      {
          "iden": "Destinations",
          "fqdn": "Ivoz\\Provider\\Domain\\Model\\Destination\\Destination",
          "platform": true,
          "brand": true,
          "client": false,
          "name": {
              "en": "Destinations",
              "es": "Destinations",
              "ca": "Destinations",
              "it": "Destinations"
          }
      }
      """
     Then the response status code should be 405
