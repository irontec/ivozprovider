Feature: Retrieve timezones
  In order to manage timezones
  As a client admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the timezones json list
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "timezones"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "tz": "Europe/Andorra",
              "id": 1
          },
          {
              "tz": "Asia/Dubai",
              "id": 2
          },
          {
              "tz": "Asia/Kabul",
              "id": 3
          },
          {
              "tz": "America/Antigua",
              "id": 4
          },
          {
              "tz": "America/Anguilla",
              "id": 5
          },
          {
              "tz": "Europe/Tirane",
              "id": 6
          },
          {
              "tz": "Asia/Yerevan",
              "id": 7
          },
          {
              "tz": "Africa/Luanda",
              "id": 8
          },
          {
              "tz": "Antarctica/McMurdo",
              "id": 9
          },
          {
              "tz": "Antarctica/Rothera",
              "id": 10
          },
          {
              "tz": "Antarctica/Palmer",
              "id": 11
          },
          {
              "tz": "Antarctica/Mawson",
              "id": 12
          },
          {
              "tz": "Antarctica/Davis",
              "id": 13
          },
          {
              "tz": "Antarctica/Casey",
              "id": 14
          },
          {
              "tz": "Antarctica/Vostok",
              "id": 15
          },
          {
              "tz": "Antarctica/DumontDUrville",
              "id": 16
          },
          {
              "tz": "Antarctica/Syowa",
              "id": 17
          },
          {
              "tz": "Antarctica/Troll",
              "id": 18
          },
          {
              "tz": "America/Argentina/Buenos_Aires",
              "id": 19
          },
          {
              "tz": "America/Argentina/Cordoba",
              "id": 20
          },
          {
              "tz": "America/Argentina/Salta",
              "id": 21
          },
          {
              "tz": "America/Argentina/Jujuy",
              "id": 22
          },
          {
              "tz": "America/Argentina/Tucuman",
              "id": 23
          },
          {
              "tz": "America/Argentina/Catamarca",
              "id": 24
          },
          {
              "tz": "America/Argentina/La_Rioja",
              "id": 25
          },
          {
              "tz": "America/Argentina/San_Juan",
              "id": 26
          },
          {
              "tz": "America/Argentina/Mendoza",
              "id": 27
          },
          {
              "tz": "America/Argentina/San_Luis",
              "id": 28
          },
          {
              "tz": "America/Argentina/Rio_Gallegos",
              "id": 29
          },
          {
              "tz": "America/Argentina/Ushuaia",
              "id": 30
          }
      ]
      """

  Scenario: Retrieve certain timezones json
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "timezones/145"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "tz": "Europe/Madrid",
          "comment": "mainland",
          "id": 145,
          "label": {
              "en": "en",
              "es": "es",
              "ca": "ca",
              "it": "it"
          },
          "country": "~"
      }
      """

  Scenario: Retrieve the full timezone json list
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "timezones?_pagination=false"
     Then the response status code should be 200
      And the streamed response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the streamed JSON node "root" should have 416 elements
      And the streamed JSON node "root[0].tz" should be equal to "Europe/Andorra"
