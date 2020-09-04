Feature: Update billable calls

  @createSchema
  Scenario: Can not update an billable call
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/billable_calls/1" with body:
    """
      {}
    """
    Then the response status code should be 405

  Scenario: Can update an billable call rates
    Given I add Authorization header
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "PUT" request to "/billable_calls/017cc7c8-eb38-4bbd-9318-524a274f7001/rate" with body:
    """
      {
          "price": 2.2,
          "cost": 1.1,
          "destinationName": "Rate test",
          "ratingPlanName": "RatingPlan Test"
      }
    """
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
          "callid": "017cc7c8-eb38-4bbd-9318-524a274f7001",
          "startTime": "2019-01-01 09:00:01",
          "duration": 0,
          "caller": "+34633646464",
          "callee": "+34633656565",
          "cost": 1.1,
          "price": 2.2,
          "priceDetails": [],
          "carrierName": null,
          "destinationName": "Rate test",
          "ratingPlanName": "RatingPlan Test",
          "endpointType": null,
          "endpointId": null,
          "endpointName": null,
          "direction": "outbound",
          "id": 2,
          "brand": 1,
          "company": 1,
          "carrier": 1,
          "invoice": null,
          "ddi": 1,
          "ddiProvider": 1
      }
    """

