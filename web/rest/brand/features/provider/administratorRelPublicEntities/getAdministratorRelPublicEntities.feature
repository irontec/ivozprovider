Feature: Manage administrator rel public entities
  In order to manage administrator rel public entities
  as a super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the administrator rel public entities json list
    Given I add Authorization header for "restrictedBrandAdmin"
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "administrator_rel_public_entities?_itemsPerPage=3"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      [
          {
              "create": false,
              "read": true,
              "update": false,
              "delete": false,
              "id": 1,
              "administrator": {
                  "username": "restrictedCompanyAdmin",
                  "pass": "*****",
                  "email": "test@irontec.com",
                  "active": true,
                  "restricted": true,
                  "name": "Admin Name",
                  "lastname": "Admin Lastname",
                  "id": 7,
                  "company": 1,
                  "timezone": 145
              },
              "publicEntity": {
                  "iden": "_RatingPlanPrices",
                  "fqdn": "Model\\RatingPlanPrices",
                  "platform": false,
                  "brand": false,
                  "client": true,
                  "id": 1,
                  "name": {
                      "en": "_RatingPlanPrices",
                      "es": "_RatingPlanPrices",
                      "ca": "_RatingPlanPrices",
                      "it": "_RatingPlanPrices"
                  }
              }
          },
          {
              "create": false,
              "read": true,
              "update": false,
              "delete": false,
              "id": 2,
              "administrator": {
                  "username": "restrictedCompanyAdmin",
                  "pass": "*****",
                  "email": "test@irontec.com",
                  "active": true,
                  "restricted": true,
                  "name": "Admin Name",
                  "lastname": "Admin Lastname",
                  "id": 7,
                  "company": 1,
                  "timezone": 145
              },
              "publicEntity": {
                  "iden": "BillableCalls",
                  "fqdn": "Ivoz\\Provider\\Domain\\Model\\BillableCall\\BillableCall",
                  "platform": true,
                  "brand": true,
                  "client": true,
                  "id": 2,
                  "name": {
                      "en": "BillableCalls",
                      "es": "BillableCalls",
                      "ca": "BillableCalls",
                      "it": "BillableCalls"
                  }
              }
          },
          {
              "create": false,
              "read": true,
              "update": false,
              "delete": false,
              "id": 3,
              "administrator": {
                  "username": "restrictedCompanyAdmin",
                  "pass": "*****",
                  "email": "test@irontec.com",
                  "active": true,
                  "restricted": true,
                  "name": "Admin Name",
                  "lastname": "Admin Lastname",
                  "id": 7,
                  "company": 1,
                  "timezone": 145
              },
              "publicEntity": {
                  "iden": "Calendars",
                  "fqdn": "Ivoz\\Provider\\Domain\\Model\\Calendar\\Calendar",
                  "platform": false,
                  "brand": false,
                  "client": true,
                  "id": 3,
                  "name": {
                      "en": "Calendars",
                      "es": "Calendars",
                      "ca": "Calendars",
                      "it": "Calendars"
                  }
              }
          }
      ]
    """

  Scenario: Retrieve certain administrator rel public entities json
    Given I add Authorization header for "restrictedBrandAdmin"
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "administrator_rel_public_entities/3"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
          "create": false,
          "read": true,
          "update": false,
          "delete": false,
          "id": 3,
          "administrator": {
              "username": "restrictedCompanyAdmin",
              "pass": "*****",
              "email": "test@irontec.com",
              "active": true,
              "restricted": true,
              "name": "Admin Name",
              "lastname": "Admin Lastname",
              "id": 7,
              "company": 1,
              "timezone": 145
          },
          "publicEntity": {
              "iden": "Calendars",
              "fqdn": "Ivoz\\Provider\\Domain\\Model\\Calendar\\Calendar",
              "platform": false,
              "brand": false,
              "client": true,
              "id": 3,
              "name": {
                  "en": "Calendars",
                  "es": "Calendars",
                  "ca": "Calendars",
                  "it": "Calendars"
              }
          }
      }
    """
