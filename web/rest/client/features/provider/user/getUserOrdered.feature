Feature: Order users
  In order to find users faster
  As a client admin
  I need to be able to order them by the entities they point to.

  @createSchema
  Scenario: Order the users json list by terminal
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "users?_order[terminal]=ASC"
     Then the response status code should be 200
      And the response should be in JSON
      And the JSON node "root" should have 3 elements
      And the JSON node "root[0].id" should be equal to "1"
      And the JSON node "root[1].id" should be equal to "2"
      And the JSON node "root[2].id" should be equal to "3"

  Scenario: Order the users json list by terminal in reverse order
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "users?_order[terminal]=DESC"
     Then the response status code should be 200
      And the response should be in JSON
      And the JSON node "root" should have 3 elements
      And the JSON node "root[0].id" should be equal to "3"
      And the JSON node "root[1].id" should be equal to "2"
      And the JSON node "root[2].id" should be equal to "1"

  Scenario: Users without extension are kept at the end of the list
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "users?_order[extension]=ASC"
     Then the response status code should be 200
      And the response should be in JSON
      And the JSON node "root" should have 3 elements
      And the JSON node "root[0].id" should be equal to "3"

  Scenario: Users without extension are kept at the end of the reversed list
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "users?_order[extension]=DESC"
     Then the response status code should be 200
      And the response should be in JSON
      And the JSON node "root" should have 3 elements
      And the JSON node "root[0].id" should be equal to "3"

  Scenario: Order the users json list by a scalar field
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "users?_order[lastname]=DESC"
     Then the response status code should be 200
      And the response should be in JSON
      And the JSON node "root" should have 3 elements
      And the JSON node "root[0].id" should be equal to "3"
      And the JSON node "root[1].id" should be equal to "2"
      And the JSON node "root[2].id" should be equal to "1"
