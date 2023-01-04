  Feature: Create destination rate group
  In order to manage destination rate group
  As a brand admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a destination rate group
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" multipart request to "/destination_rate_groups" with body:
    """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="destinationRateGroup"

{
    "name": {
        "en": "New DR",
        "es": "New DR",
        "ca": "New DR",
        "it": "New DR"
    },
    "description": {
        "en": "",
        "es": "",
        "ca": "",
        "it": ""
    },
    "currency": "1"
}
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="file"; filename="prices.csv"
Content-Type: text/csv

"Spain",+34,0.012,0.012,1
"Portugal",+351,0.008,0.008,1
"France",+33,0.012,0.012,1
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
          "status": "waiting",
          "lastExecutionError": null,
          "deductibleConnectionFee": false,
          "id": 3,
          "name": {
              "en": "New DR",
              "es": "New DR",
              "ca": "New DR",
              "it": "New DR"
          },
          "description": {
              "en": "",
              "es": "",
              "ca": "",
              "it": ""
          },
          "file": {
              "fileSize": 84,
              "mimeType": "text/plain; charset=us-ascii",
              "baseName": "prices.csv",
              "importerArguments": {
                    "scape": null,
                    "columns": [
                        "destinationName",
                        "destinationPrefix",
                        "rateCost",
                        "connectionCharge",
                        "rateIncrement"
                    ],
                    "delimiter": ",",
                    "enclosure": "\"",
                    "ignoreFirst": true
                }
          },
          "currency": 1
      }
    """

  Scenario: Retrieve created destination rate group
    Given I add Brand Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "destination_rate_groups/3"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be like:
    """
      {
          "status": "waiting",
          "lastExecutionError": null,
          "deductibleConnectionFee": false,
          "id": 3,
          "name": {
              "en": "New DR",
              "es": "New DR",
              "ca": "New DR",
              "it": "New DR"
          },
          "description": {
              "en": "",
              "es": "",
              "ca": "",
              "it": ""
          },
          "file": {
              "fileSize": 84,
              "mimeType": "text/plain; charset=us-ascii",
              "baseName": "prices.csv",
              "importerArguments": {
                    "scape": null,
                    "columns": [
                        "destinationName",
                        "destinationPrefix",
                        "rateCost",
                        "connectionCharge",
                        "rateIncrement"
                    ],
                    "delimiter": ",",
                    "enclosure": "\"",
                    "ignoreFirst": true
                }
          },
          "currency": "~"
      }
    """
