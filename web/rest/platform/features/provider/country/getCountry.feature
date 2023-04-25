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
              "code": "DZ",
              "countryCode": "+213",
              "id": 62,
              "name": {
                  "en": "Algeria",
                  "es": "Algeria",
                  "ca": "Algeria",
                  "it": "Algeria"
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
              "code": "SH",
              "countryCode": "+290",
              "id": 199,
              "name": {
                  "en": "Ascensión y Tristán de Acuña",
                  "es": "Santa Elena",
                  "ca": "Santa Elena",
                  "it": "Ascensión y Tristán de Acuña"
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
              "code": "AZ",
              "countryCode": "+994",
              "id": 16,
              "name": {
                  "en": "Azerbaijan",
                  "es": "Azerbayán",
                  "ca": "Azerbayán",
                  "it": "Azerbaijan"
              }
          },
          {
              "code": "BS",
              "countryCode": "+1242",
              "id": 32,
              "name": {
                  "en": "Bahamas",
                  "es": "Bahamas",
                  "ca": "Bahamas",
                  "it": "Bahamas"
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
              "code": "BY",
              "countryCode": "+375",
              "id": 36,
              "name": {
                  "en": "Belarus",
                  "es": "Bielorrusia",
                  "ca": "Bielorrusia",
                  "it": "Belarus"
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
                  "it": "Belgium"
              }
          },
          {
              "code": "BZ",
              "countryCode": "+501",
              "id": 37,
              "name": {
                  "en": "Belize",
                  "es": "Belice",
                  "ca": "Belice",
                  "it": "Belize"
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
                  "it": "Benin"
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
              "code": "BT",
              "countryCode": "+975",
              "id": 33,
              "name": {
                  "en": "Bhutan",
                  "es": "Bhután",
                  "ca": "Bhután",
                  "it": "Bhutan"
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
              "code": "BW",
              "countryCode": "+267",
              "id": 35,
              "name": {
                  "en": "Botswana",
                  "es": "Botsuana",
                  "ca": "Botsuana",
                  "it": "Botswana"
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
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "countries?_pagination=false"
     Then the response status code should be 200
      And the streamed response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the streamed JSON node "root" should have 249 elements
      And the streamed JSON node "root[0].code" should be equal to "AF"
