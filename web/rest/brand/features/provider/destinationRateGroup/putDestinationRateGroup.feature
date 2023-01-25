Feature: Update destination rate group
  In order to manage destination rate group
  As a brand admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a destination rate group
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryROBrG71LG0e8DuZ8"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" multipart request to "/destination_rate_groups/2" with body:
    """
------IvozProviderFormBoundaryROBrG71LG0e8DuZ8
Content-Disposition: form-data; name="destinationRateGroup"

{
    "name": {
        "en": "Updated Standard",
        "es": "Standard Actualizado",
        "it": "Standard",
        "ca": "Standard Actualizado"
    },
    "description": {
        "en": "New Description",
        "es": "Descripción nueva",
        "it": "",
        "ca": "Descripción nueva"
    },
    "currency": 2,
    "importerArguments": {
        "scape": null,
        "columns": [
            "destinationPrefix",
            "destinationName",
            "connectionCharge",
            "rateCost",
            "rateIncrement"
        ],
        "delimiter": ",",
        "enclosure": "\"",
        "ignoreFirst": false
    }
}
------IvozProviderFormBoundaryROBrG71LG0e8DuZ8
Content-Disposition: form-data; name="file"; filename="prices.csv"
Content-Type: text/csv

"Spain",+34,0.012,0.012,1
"Portugal",+351,0.008,0.008,1
"France",+33,0.012,0.012,1
------IvozProviderFormBoundaryROBrG71LG0e8DuZ8--

    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "status": "waiting",
          "lastExecutionError": null,
          "deductibleConnectionFee": false,
          "id": 2,
          "name": {
              "en": "Updated Standard",
              "es": "Standard Actualizado",
              "ca": "Standard Actualizado",
              "it": "Standard"
          },
          "description": {
              "en": "New Description",
              "es": "Descripción nueva",
              "ca": "Descripción nueva",
              "it": ""
          },
          "file": {
              "fileSize": 84,
              "mimeType": "text/plain; charset=us-ascii",
              "baseName": "prices.csv",
              "importerArguments": {
                  "scape": null,
                  "columns": [
                      "destinationPrefix",
                      "destinationName",
                      "connectionCharge",
                      "rateCost",
                      "rateIncrement"
                  ],
                  "delimiter": ",",
                  "enclosure": "\"",
                  "ignoreFirst": false
              }
          },
          "currency": 2
      }
    """