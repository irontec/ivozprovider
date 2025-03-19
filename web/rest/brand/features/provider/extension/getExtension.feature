Feature: Retrieve extensions
  In order to manage extensions
  As a brand admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the extensions json list
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "extensions"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
        {
            "number": "101",
            "routeType": "user",
            "numberValue": null,
            "friendValue": null,
            "id": 1,
            "user": 1,
            "numberCountry": null
        },
        {
            "number": "102",
            "routeType": "user",
            "numberValue": null,
            "friendValue": null,
            "id": 2,
            "user": 2,
            "numberCountry": null
        },
        {
            "number": "12346",
            "routeType": "number",
            "numberValue": "946006060",
            "friendValue": null,
            "id": 3,
            "user": null,
            "numberCountry": 70
        },
        {
            "number": "987",
            "routeType": null,
            "numberValue": null,
            "friendValue": null,
            "id": 4,
            "user": null,
            "numberCountry": null
        },
        {
            "number": "988",
            "routeType": "user",
            "numberValue": null,
            "friendValue": null,
            "id": 5,
            "user": 3,
            "numberCountry": null
        },
        {
            "number": "989",
            "routeType": "user",
            "numberValue": null,
            "friendValue": null,
            "id": 6,
            "user": 4,
            "numberCountry": null
        }
      ]
      """
