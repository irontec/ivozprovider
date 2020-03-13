Feature: Authorization checking
  In order to use the API
  As a client software developer
  I need to be authorized to access a given resource.

  @createSchema
  Scenario: Collection responses should contain pagination headers
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "/billable_calls"
     Then the header "X-First-Page" should be equal to "/billable_calls?_page=1"
      And the header "X-Next-Page" should be equal to "/billable_calls?_page=2"
      And the header "X-Last-Page" should be equal to "/billable_calls?_page=4"
      And the header "X-Total-Items" should be equal to "100"
      And the header "X-Total-Pages" should be equal to "4"

  Scenario: Items per page can be defined
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "/billable_calls?_itemsPerPage=10"
     Then the header "X-Last-Page" should be equal to "/billable_calls?_page=10"
      And the header "X-Total-Pages" should be equal to "10"

  Scenario: Specific page can be requested
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "/billable_calls?_page=2"
     Then the header "X-Next-Page" should be equal to "/billable_calls?_page=3"

  Scenario: Pagination can be disabled on some resources
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "billable_calls?_pagination=false"
     Then the response status code should be 200
      And the streamed response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the streamed JSON node "root" should have 100 elements
