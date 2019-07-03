Feature: Retrieve countries
  In order to manage countries
  as a super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the countries json list
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "countries"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      [
          {
              "code": "AD",
              "countryCode": "+376",
              "id": 1,
              "name": {
                  "en": "Andorra",
                  "es": "Andorra"
              }
          },
          {
              "code": "AE",
              "countryCode": "+971",
              "id": 2,
              "name": {
                  "en": "United Arab Emirates",
                  "es": "Emiratos \u00c1rabes Unidos"
              }
          },
          {
              "code": "AF",
              "countryCode": "+93",
              "id": 3,
              "name": {
                  "en": "Afghanistan",
                  "es": "Afganist\u00e1n"
              }
          },
          {
              "code": "AG",
              "countryCode": "+1268",
              "id": 4,
              "name": {
                  "en": "Antigua and Barbuda",
                  "es": "Antigua y Barbuda"
              }
          },
          {
              "code": "AI",
              "countryCode": "+1264",
              "id": 5,
              "name": {
                  "en": "Anguilla",
                  "es": "Anguila"
              }
          },
          {
              "code": "AL",
              "countryCode": "+355",
              "id": 6,
              "name": {
                  "en": "Albania",
                  "es": "Albania"
              }
          },
          {
              "code": "AM",
              "countryCode": "+374",
              "id": 7,
              "name": {
                  "en": "Armenia",
                  "es": "Armenia"
              }
          },
          {
              "code": "AO",
              "countryCode": "+244",
              "id": 8,
              "name": {
                  "en": "Angola",
                  "es": "Angola"
              }
          },
          {
              "code": "AQ",
              "countryCode": "+672",
              "id": 9,
              "name": {
                  "en": "Antarctica",
                  "es": "Ant\u00e1rtida"
              }
          },
          {
              "code": "AR",
              "countryCode": "+54",
              "id": 10,
              "name": {
                  "en": "Argentina",
                  "es": "Argentina"
              }
          },
          {
              "code": "AS",
              "countryCode": "+1684",
              "id": 11,
              "name": {
                  "en": "American Samoa",
                  "es": "Samoa Americana"
              }
          },
          {
              "code": "AT",
              "countryCode": "+43",
              "id": 12,
              "name": {
                  "en": "Austria",
                  "es": "Austria"
              }
          },
          {
              "code": "AU",
              "countryCode": "+61",
              "id": 13,
              "name": {
                  "en": "Australia",
                  "es": "Australia"
              }
          },
          {
              "code": "AW",
              "countryCode": "+297",
              "id": 14,
              "name": {
                  "en": "Aruba",
                  "es": "Aruba"
              }
          },
          {
              "code": "AX",
              "countryCode": "+358",
              "id": 15,
              "name": {
                  "en": "\u00c5land Islands",
                  "es": "Islas de \u00c5land"
              }
          },
          {
              "code": "AZ",
              "countryCode": "+994",
              "id": 16,
              "name": {
                  "en": "Azerbaijan",
                  "es": "Azerbay\u00e1n"
              }
          },
          {
              "code": "BA",
              "countryCode": "+387",
              "id": 17,
              "name": {
                  "en": "Bosnia and Herzegovina",
                  "es": "Bosnia y Herzegovina"
              }
          },
          {
              "code": "BB",
              "countryCode": "+1246",
              "id": 18,
              "name": {
                  "en": "Barbados",
                  "es": "Barbados"
              }
          },
          {
              "code": "BD",
              "countryCode": "+880",
              "id": 19,
              "name": {
                  "en": "Bangladesh",
                  "es": "Bangladesh"
              }
          },
          {
              "code": "BE",
              "countryCode": "+32",
              "id": 20,
              "name": {
                  "en": "Belgium",
                  "es": "B\u00e9lgica"
              }
          },
          {
              "code": "BF",
              "countryCode": "+226",
              "id": 21,
              "name": {
                  "en": "Burkina Faso",
                  "es": "Burkina Faso"
              }
          },
          {
              "code": "BG",
              "countryCode": "+359",
              "id": 22,
              "name": {
                  "en": "Bulgaria",
                  "es": "Bulgaria"
              }
          },
          {
              "code": "BH",
              "countryCode": "+973",
              "id": 23,
              "name": {
                  "en": "Bahrain",
                  "es": "Bahrein"
              }
          },
          {
              "code": "BI",
              "countryCode": "+257",
              "id": 24,
              "name": {
                  "en": "Burundi",
                  "es": "Burundi"
              }
          },
          {
              "code": "BJ",
              "countryCode": "+229",
              "id": 25,
              "name": {
                  "en": "Benin",
                  "es": "Ben\u00edn"
              }
          },
          {
              "code": "BL",
              "countryCode": "+590",
              "id": 26,
              "name": {
                  "en": "Saint Barth\u00e9lemy",
                  "es": "San Bartolom\u00e9"
              }
          },
          {
              "code": "BM",
              "countryCode": "+1441",
              "id": 27,
              "name": {
                  "en": "Bermuda Islands",
                  "es": "Islas Bermudas"
              }
          },
          {
              "code": "BN",
              "countryCode": "+673",
              "id": 28,
              "name": {
                  "en": "Brunei",
                  "es": "Brun\u00e9i"
              }
          },
          {
              "code": "BO",
              "countryCode": "+591",
              "id": 29,
              "name": {
                  "en": "Bolivia",
                  "es": "Bolivia"
              }
          },
          {
              "code": "BQ",
              "countryCode": "+599",
              "id": 30,
              "name": {
                  "en": "Bonaire",
                  "es": "Bonaire"
              }
          }
      ]
    """

  Scenario: Retrieve certain country json
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "countries/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
       {
          "code": "AD",
          "countryCode": "+376",
          "id": 1,
          "name": {
              "en": "Andorra",
              "es": "Andorra"
          },
          "zone": {
              "en": "Europe",
              "es": "Andorra"
          }
      }
    """

  Scenario: Retrieve the full country json list
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "countries?_pagination=false"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON node "root" should have 249 elements
    And the JSON node "root[0].code" should be equal to "AD"
