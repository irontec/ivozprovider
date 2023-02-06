Feature: Retrieve public entities
  In order to manage public entities
  as a super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the public entities json list
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "public_entities?_itemsPerPage=5"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "iden": "_RatingPlanPrices",
              "id": 1,
              "name": {
                  "en": "_RatingPlanPrices",
                  "es": "_RatingPlanPrices",
                  "ca": "_RatingPlanPrices",
                  "it": "_RatingPlanPrices"
              }
          },
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
              "iden": "Calendars",
              "id": 3,
              "name": {
                  "en": "Calendars",
                  "es": "Calendars",
                  "ca": "Calendars",
                  "it": "Calendars"
              }
          },
          {
              "iden": "CalendarPeriods",
              "id": 4,
              "name": {
                  "en": "CalendarPeriods",
                  "es": "CalendarPeriods",
                  "ca": "CalendarPeriods",
                  "it": "CalendarPeriods"
              }
          },
          {
              "iden": "CalendarPeriodsRelSchedules",
              "id": 5,
              "name": {
                  "en": "CalendarPeriodsRelSchedules",
                  "es": "CalendarPeriodsRelSchedules",
                  "ca": "CalendarPeriodsRelSchedules",
                  "it": "CalendarPeriodsRelSchedules"
              }
          }
      ]
      """

  Scenario: Retrieve certain feature json
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "public_entities/5"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "iden": "CalendarPeriodsRelSchedules",
          "fqdn": "Ivoz\\Provider\\Domain\\Model\\CalendarPeriodsRelSchedule\\CalendarPeriodsRelSchedule",
          "platform": false,
          "brand": false,
          "client": true,
          "id": 5,
          "name": {
              "en": "CalendarPeriodsRelSchedules",
              "es": "CalendarPeriodsRelSchedules",
              "ca": "CalendarPeriodsRelSchedules",
              "it": "CalendarPeriodsRelSchedules"
          }
      }
      """
