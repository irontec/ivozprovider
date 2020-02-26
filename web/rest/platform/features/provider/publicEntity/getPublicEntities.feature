Feature: Retrieve public entities
  In order to manage public entities
  as a super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the public entities json list
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "public_entities?_itemsPerPage=5"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      [
          {
              "iden": "BillableCalls",
              "id": 2,
              "name": {
                  "en": "BillableCalls",
                  "es": "BillableCalls",
                  "ca": "BillableCalls",
                  "it": "BillableCalls"
              }
          },
          {
              "iden": "Companies",
              "id": 11,
              "name": {
                  "en": "Companies",
                  "es": "Companies",
                  "ca": "Companies",
                  "it": "Companies"
              }
          },
          {
              "iden": "Countries",
              "id": 20,
              "name": {
                  "en": "Countries",
                  "es": "Countries",
                  "ca": "Countries",
                  "it": "Countries"
              }
          },
          {
              "iden": "Features",
              "id": 30,
              "name": {
                  "en": "Features",
                  "es": "Features",
                  "ca": "Features",
                  "it": "Features"
              }
          },
          {
              "iden": "Invoices",
              "id": 37,
              "name": {
                  "en": "Invoices",
                  "es": "Invoices",
                  "ca": "Invoices",
                  "it": "Invoices"
              }
          }
      ]
    """

  Scenario: Retrieve certain feature json
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "public_entities/80"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
          "iden": "Destinations",
          "fqdn": "Ivoz\\Provider\\Domain\\Model\\Destination\\Destination",
          "platform": true,
          "brand": true,
          "client": false,
          "id": 80,
          "name": {
              "en": "Destinations",
              "es": "Destinations",
              "ca": "Destinations",
              "it": "Destinations"
          }
      }
    """
