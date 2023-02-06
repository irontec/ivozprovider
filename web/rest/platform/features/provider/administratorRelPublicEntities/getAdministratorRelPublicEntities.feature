Feature: Manage administrator rel public entities
  In order to manage administrator rel public entities
  as a super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the administrator rel public entities json list
    Given I add Authorization header
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
              "id": 67,
              "administrator": {
                  "username": "restrictedBrandAdmin",
                  "pass": "*****",
                  "email": "restrictedAdmin@irontec.com",
                  "active": true,
                  "restricted": true,
                  "name": "RestrictedAdmin",
                  "lastname": "Lastname",
                  "id": 6,
                  "brand": 1,
                  "company": null,
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
              "id": 70,
              "administrator": {
                  "username": "restrictedBrandAdmin",
                  "pass": "*****",
                  "email": "restrictedAdmin@irontec.com",
                  "active": true,
                  "restricted": true,
                  "name": "RestrictedAdmin",
                  "lastname": "Lastname",
                  "id": 6,
                  "brand": 1,
                  "company": null,
                  "timezone": 145
              },
              "publicEntity": {
                  "iden": "Companies",
                  "fqdn": "Ivoz\\Provider\\Domain\\Model\\Company\\Company",
                  "platform": true,
                  "brand": true,
                  "client": true,
                  "id": 11,
                  "name": {
                      "en": "Companies",
                      "es": "Companies",
                      "ca": "Companies",
                      "it": "Companies"
                  }
              }
          },
          {
              "create": false,
              "read": true,
              "update": false,
              "delete": false,
              "id": 71,
              "administrator": {
                  "username": "restrictedBrandAdmin",
                  "pass": "*****",
                  "email": "restrictedAdmin@irontec.com",
                  "active": true,
                  "restricted": true,
                  "name": "RestrictedAdmin",
                  "lastname": "Lastname",
                  "id": 6,
                  "brand": 1,
                  "company": null,
                  "timezone": 145
              },
              "publicEntity": {
                  "iden": "Countries",
                  "fqdn": "Ivoz\\Provider\\Domain\\Model\\Country\\Country",
                  "platform": true,
                  "brand": true,
                  "client": true,
                  "id": 20,
                  "name": {
                      "en": "Countries",
                      "es": "Countries",
                      "ca": "Countries",
                      "it": "Countries"
                  }
              }
          }
      ]
      """

  Scenario: Retrieve certain administrator rel public entities json
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "administrator_rel_public_entities/71"
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
        "id": 71,
        "administrator": {
            "username": "restrictedBrandAdmin",
            "pass": "*****",
            "email": "restrictedAdmin@irontec.com",
            "active": true,
            "restricted": true,
            "name": "RestrictedAdmin",
            "lastname": "Lastname",
            "id": 6,
            "brand": 1,
            "company": null,
            "timezone": 145
        },
        "publicEntity": {
            "iden": "Countries",
            "fqdn": "Ivoz\\Provider\\Domain\\Model\\Country\\Country",
            "platform": true,
            "brand": true,
            "client": true,
            "id": 20,
            "name": {
                "en": "Countries",
                "es": "Countries",
                "ca": "Countries",
                "it": "Countries"
            }
        }
      }
      """
