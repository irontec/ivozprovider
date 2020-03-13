Feature: Retrieve countries
  In order to manage countries
  As a client admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the countries json list
    Given I add Company Authorization header
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
                  "es": "Andorra",
                  "ca": "Andorra",
                  "it": "Andorra"
              }
          },
          {
              "code": "AE",
              "countryCode": "+971",
              "id": 2,
              "name": {
                  "en": "United Arab Emirates",
                  "es": "Emiratos Árabes Unidos",
                  "ca": "Emiratos Árabes Unidos",
                  "it": "United Arab Emirates"
              }
          },
          {
              "code": "AF",
              "countryCode": "+93",
              "id": 3,
              "name": {
                  "en": "Afghanistan",
                  "es": "Afganistán",
                  "ca": "Afganistán",
                  "it": "Afghanistan"
              }
          },
          {
              "code": "AG",
              "countryCode": "+1268",
              "id": 4,
              "name": {
                  "en": "Antigua and Barbuda",
                  "es": "Antigua y Barbuda",
                  "ca": "Antigua y Barbuda",
                  "it": "Antigua and Barbuda"
              }
          },
          {
              "code": "AI",
              "countryCode": "+1264",
              "id": 5,
              "name": {
                  "en": "Anguilla",
                  "es": "Anguila",
                  "ca": "Anguila",
                  "it": "Anguilla"
              }
          },
          {
              "code": "AL",
              "countryCode": "+355",
              "id": 6,
              "name": {
                  "en": "Albania",
                  "es": "Albania",
                  "ca": "Albania",
                  "it": "Albania"
              }
          },
          {
              "code": "AM",
              "countryCode": "+374",
              "id": 7,
              "name": {
                  "en": "Armenia",
                  "es": "Armenia",
                  "ca": "Armenia",
                  "it": "Armenia"
              }
          },
          {
              "code": "AO",
              "countryCode": "+244",
              "id": 8,
              "name": {
                  "en": "Angola",
                  "es": "Angola",
                  "ca": "Angola",
                  "it": "Angola"
              }
          },
          {
              "code": "AQ",
              "countryCode": "+672",
              "id": 9,
              "name": {
                  "en": "Antarctica",
                  "es": "Antártida",
                  "ca": "Antártida",
                  "it": "Antarctica"
              }
          },
          {
              "code": "AR",
              "countryCode": "+54",
              "id": 10,
              "name": {
                  "en": "Argentina",
                  "es": "Argentina",
                  "ca": "Argentina",
                  "it": "Argentina"
              }
          },
          {
              "code": "AS",
              "countryCode": "+1684",
              "id": 11,
              "name": {
                  "en": "American Samoa",
                  "es": "Samoa Americana",
                  "ca": "Samoa Americana",
                  "it": "American Samoa"
              }
          },
          {
              "code": "AT",
              "countryCode": "+43",
              "id": 12,
              "name": {
                  "en": "Austria",
                  "es": "Austria",
                  "ca": "Austria",
                  "it": "Austria"
              }
          },
          {
              "code": "AU",
              "countryCode": "+61",
              "id": 13,
              "name": {
                  "en": "Australia",
                  "es": "Australia",
                  "ca": "Australia",
                  "it": "Australia"
              }
          },
          {
              "code": "AW",
              "countryCode": "+297",
              "id": 14,
              "name": {
                  "en": "Aruba",
                  "es": "Aruba",
                  "ca": "Aruba",
                  "it": "Aruba"
              }
          },
          {
              "code": "AX",
              "countryCode": "+358",
              "id": 15,
              "name": {
                  "en": "\u00c5land Islands",
                  "es": "Islas de \u00c5land",
                  "ca": "Islas de \u00c5land",
                  "it": "\u00c5land Islands"
              }
          },
          {
              "code": "AZ",
              "countryCode": "+994",
              "id": 16,
              "name": {
                  "en": "Azerbaijan",
                  "es": "Azerbay\u00e1n",
                  "ca": "Azerbay\u00e1n",
                  "it": "Azerbaijan"
              }
          },
          {
              "code": "BA",
              "countryCode": "+387",
              "id": 17,
              "name": {
                  "en": "Bosnia and Herzegovina",
                  "es": "Bosnia y Herzegovina",
                  "ca": "Bosnia y Herzegovina",
                  "it": "Bosnia and Herzegovina"
              }
          },
          {
              "code": "BB",
              "countryCode": "+1246",
              "id": 18,
              "name": {
                  "en": "Barbados",
                  "es": "Barbados",
                  "ca": "Barbados",
                  "it": "Barbados"
              }
          },
          {
              "code": "BD",
              "countryCode": "+880",
              "id": 19,
              "name": {
                  "en": "Bangladesh",
                  "es": "Bangladesh",
                  "ca": "Bangladesh",
                  "it": "Bangladesh"
              }
          },
          {
              "code": "BE",
              "countryCode": "+32",
              "id": 20,
              "name": {
                  "en": "Belgium",
                  "es": "B\u00e9lgica",
                  "ca": "B\u00e9lgica",
                  "it": "Belgium"
              }
          },
          {
              "code": "BF",
              "countryCode": "+226",
              "id": 21,
              "name": {
                  "en": "Burkina Faso",
                  "es": "Burkina Faso",
                  "ca": "Burkina Faso",
                  "it": "Burkina Faso"
              }
          },
          {
              "code": "BG",
              "countryCode": "+359",
              "id": 22,
              "name": {
                  "en": "Bulgaria",
                  "es": "Bulgaria",
                  "ca": "Bulgaria",
                  "it": "Bulgaria"
              }
          },
          {
              "code": "BH",
              "countryCode": "+973",
              "id": 23,
              "name": {
                  "en": "Bahrain",
                  "es": "Bahrein",
                  "ca": "Bahrein",
                  "it": "Bahrain"
              }
          },
          {
              "code": "BI",
              "countryCode": "+257",
              "id": 24,
              "name": {
                  "en": "Burundi",
                  "es": "Burundi",
                  "ca": "Burundi",
                  "it": "Burundi"
              }
          },
          {
              "code": "BJ",
              "countryCode": "+229",
              "id": 25,
              "name": {
                  "en": "Benin",
                  "es": "Ben\u00edn",
                  "ca": "Ben\u00edn",
                  "it": "Benin"
              }
          },
          {
              "code": "BL",
              "countryCode": "+590",
              "id": 26,
              "name": {
                  "en": "Saint Barth\u00e9lemy",
                  "es": "San Bartolom\u00e9",
                  "ca": "San Bartolom\u00e9",
                  "it": "Saint Barth\u00e9lemy"
              }
          },
          {
              "code": "BM",
              "countryCode": "+1441",
              "id": 27,
              "name": {
                  "en": "Bermuda Islands",
                  "es": "Islas Bermudas",
                  "ca": "Islas Bermudas",
                  "it": "Bermuda Islands"
              }
          },
          {
              "code": "BN",
              "countryCode": "+673",
              "id": 28,
              "name": {
                  "en": "Brunei",
                  "es": "Brun\u00e9i",
                  "ca": "Brun\u00e9i",
                  "it": "Brunei"
              }
          },
          {
              "code": "BO",
              "countryCode": "+591",
              "id": 29,
              "name": {
                  "en": "Bolivia",
                  "es": "Bolivia",
                  "ca": "Bolivia",
                  "it": "Bolivia"
              }
          },
          {
              "code": "BQ",
              "countryCode": "+599",
              "id": 30,
              "name": {
                  "en": "Bonaire",
                  "es": "Bonaire",
                  "ca": "Bonaire",
                  "it": "Bonaire"
              }
          }
      ]
    """

  Scenario: Retrieve certain country json
    Given I add Company Authorization header
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
              "es": "Andorra",
              "ca": "Andorra",
              "it": "Andorra"
          },
          "zone": {
              "en": "Europe",
              "es": "Europa",
              "ca": "Europa",
              "it": "Europe"
          }
      }
    """

  Scenario: Retrieve the full country json list
    Given I add Company Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "countries?_pagination=false"
    Then the response status code should be 200
    And the streamed response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the streamed JSON node "root" should have 249 elements
    And the streamed JSON node "root[0].code" should be equal to "AD"
