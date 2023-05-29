Feature: Create billable calls

  @createSchema
  Scenario: Can not create billable calls
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/billable_calls" with body:
      """
      {}
      """
     Then the response status code should be 405

  @createSchema
  Scenario: Rerate billable calls
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/billable_calls/rerate" with body:
      """
      [1,2]
      """
     Then the response status code should be 200

  Scenario: Retrieve rerated billable calls
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "billable_calls?_itemsPerPage=2&_properties[]=cost&_properties[]=price&_properties[]=id"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "cost": null,
              "price": null,
              "id": 1
          },
          {
              "cost": null,
              "price": null,
              "id": 2
          }
      ]
      """
