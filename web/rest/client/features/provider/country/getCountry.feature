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
                  "it": "Andorra",
                  "eu": "Andorra"
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
                  "it": "United Arab Emirates",
                  "eu": "United Arab Emirates"
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
                  "it": "Afghanistan",
                  "eu": "Afghanistan"
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
                  "it": "Antigua and Barbuda",
                  "eu": "Antigua and Barbuda"
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
                  "it": "Anguilla",
                  "eu": "Anguilla"
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
                  "it": "Albania",
                  "eu": "Albania"
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
                  "it": "Armenia",
                  "eu": "Armenia"
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
                  "it": "Angola",
                  "eu": "Angola"
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
                  "it": "Antarctica",
                  "eu": "Antarctica"
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
                  "it": "Argentina",
                  "eu": "Argentina"
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
                  "it": "American Samoa",
                  "eu": "American Samoa"
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
                  "it": "Austria",
                  "eu": "Austria"
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
                  "it": "Australia",
                  "eu": "Australia"
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
                  "it": "Aruba",
                  "eu": "Aruba"
              }
          },
          {
              "code": "AX",
              "countryCode": "+358",
              "id": 15,
              "name": {
                  "en": "Åland Islands",
                  "es": "Islas de Åland",
                  "ca": "Islas de Åland",
                  "it": "Åland Islands",
                  "eu": "Åland Islands"
              }
          },
          {
              "code": "AZ",
              "countryCode": "+994",
              "id": 16,
              "name": {
                  "en": "Azerbaijan",
                  "es": "Azerbayán",
                  "ca": "Azerbayán",
                  "it": "Azerbaijan",
                  "eu": "Azerbaijan"
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
                  "it": "Bosnia and Herzegovina",
                  "eu": "Bosnia and Herzegovina"
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
                  "it": "Barbados",
                  "eu": "Barbados"
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
                  "it": "Bangladesh",
                  "eu": "Bangladesh"
              }
          },
          {
              "code": "BE",
              "countryCode": "+32",
              "id": 20,
              "name": {
                  "en": "Belgium",
                  "es": "Bélgica",
                  "ca": "Bélgica",
                  "it": "Belgium",
                  "eu": "Belgium"
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
                  "it": "Burkina Faso",
                  "eu": "Burkina Faso"
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
                  "it": "Bulgaria",
                  "eu": "Bulgaria"
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
                  "it": "Bahrain",
                  "eu": "Bahrain"
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
                  "it": "Burundi",
                  "eu": "Burundi"
              }
          },
          {
              "code": "BJ",
              "countryCode": "+229",
              "id": 25,
              "name": {
                  "en": "Benin",
                  "es": "Benín",
                  "ca": "Benín",
                  "it": "Benin",
                  "eu": "Benin"
              }
          },
          {
              "code": "BL",
              "countryCode": "+590",
              "id": 26,
              "name": {
                  "en": "Saint Barthélemy",
                  "es": "San Bartolomé",
                  "ca": "San Bartolomé",
                  "it": "Saint Barthélemy",
                  "eu": "Saint Barthélemy"
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
                  "it": "Bermuda Islands",
                  "eu": "Bermuda Islands"
              }
          },
          {
              "code": "BN",
              "countryCode": "+673",
              "id": 28,
              "name": {
                  "en": "Brunei",
                  "es": "Brunéi",
                  "ca": "Brunéi",
                  "it": "Brunei",
                  "eu": "Brunei"
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
                  "it": "Bolivia",
                  "eu": "Bolivia"
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
                  "it": "Bonaire",
                  "eu": "Bonaire"
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
              "it": "Andorra",
              "eu": "Andorra"
          },
          "zone": {
              "en": "Europe",
              "es": "Europa",
              "ca": "Europa",
              "it": "Europe",
              "eu": "Europa"
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
