Feature: DDIs mass import
  In order to provision numbering in bulk
  As a brand admin
  I need to be able to create and complete DDIs from a CSV file

  @createSchema
  Scenario: Mass import is not available through GET requests
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "/ddis/mass_import"
     Then the response status code should be 404

  Scenario: Mass import without csv file is a bad request
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" multipart request to "/ddis/mass_import" with body:
    """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="country"

68
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
     Then the response status code should be 400

  Scenario: Mass import without country is a bad request even with a company
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" multipart request to "/ddis/mass_import" with body:
    """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="company"

1
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="csv"; filename="ddis.csv"
Content-Type: text/csv

944048182
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
     Then the response status code should be 400
      And the JSON should be like:
      """
      {
          "detail": "Country is required",
          "*": "~"
      }
      """

  Scenario: Mass import is forbidden to restricted admins without write privileges on DDIs
    Given I add restricted Brand Authorization header
     When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" multipart request to "/ddis/mass_import" with body:
    """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="country"

68
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="csv"; filename="ddis.csv"
Content-Type: text/csv

944048182
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
     Then the response status code should be 403

  Scenario: Mass import into an unknown company is not found
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" multipart request to "/ddis/mass_import" with body:
    """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="company"

999
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="country"

68
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="csv"; filename="ddis.csv"
Content-Type: text/csv

944048182
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
     Then the response status code should be 404

  Scenario: Mass import into another brand company is forbidden
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" multipart request to "/ddis/mass_import" with body:
    """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="company"

6
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="country"

68
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="csv"; filename="ddis.csv"
Content-Type: text/csv

944048182
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
     Then the response status code should be 403

  Scenario: Mass import into a wholesale company is a bad request
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" multipart request to "/ddis/mass_import" with body:
    """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="company"

5
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="country"

68
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="csv"; filename="ddis.csv"
Content-Type: text/csv

944048182
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
     Then the response status code should be 400
      And the JSON should be like:
      """
      {
          "detail": "DDIs cannot be imported into wholesale clients",
          "*": "~"
      }
      """

  Scenario: Mass import with an unknown country is not found
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" multipart request to "/ddis/mass_import" with body:
    """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="country"

999
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="csv"; filename="ddis.csv"
Content-Type: text/csv

944048182
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
     Then the response status code should be 404

  Scenario: Mass import with a DDI provider that is not of the brand is not found and imports nothing
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" multipart request to "/ddis/mass_import" with body:
    """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="country"

68
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="ddiProvider"

999
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="csv"; filename="ddis.csv"
Content-Type: text/csv

944048182
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
     Then the response status code should be 404
      And the JSON should be like:
      """
      {
          "detail": "DDI provider not found",
          "*": "~"
      }
      """

  Scenario: The DDI rejected with the DDI provider was not created
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "ddis?ddi=944048182"
     Then the response status code should be 200
      And the JSON should be equal to:
      """
      []
      """

  Scenario: The documentation example creates the DDIs in the company with the country and the DDI provider
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" multipart request to "/ddis/mass_import" with body:
    """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="company"

1
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="country"

68
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="ddiProvider"

1
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="csv"; filename="ddis.csv"
Content-Type: text/csv

944048182
944048183
944048184
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
     Then the response status code should be 201
      And the JSON should be equal to:
      """
      {
          "created": 3,
          "updated": 0,
          "skipped": 0,
          "failed": 0,
          "updatedLines": [],
          "skippedRows": [],
          "errors": []
      }
      """

  Scenario: Created DDIs belong to the company and the DDI provider and keep the default values
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "ddis/7"
     Then the response status code should be 200
      And the JSON should be like:
      """
      {
          "ddi": "944048182",
          "ddie164": "+34944048182",
          "description": null,
          "type": "inout",
          "useDdiProviderRoutingTag": true,
          "id": 7,
          "company": {
              "id": 1,
              "*": "~"
          },
          "ddiProvider": {
              "id": 1,
              "*": "~"
          },
          "country": {
              "id": 68,
              "*": "~"
          },
          "routingTag": null
      }
      """

  Scenario: The given country is used even when it is not the company country
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" multipart request to "/ddis/mass_import" with body:
    """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="company"

1
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="country"

1
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="csv"; filename="ddis.csv"
Content-Type: text/csv

944048185
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
     Then the response status code should be 201
      And the JSON should be equal to:
      """
      {
          "created": 1,
          "updated": 0,
          "skipped": 0,
          "failed": 0,
          "updatedLines": [],
          "skippedRows": [],
          "errors": []
      }
      """

  Scenario: The DDI created with another country has that country prefix and no DDI provider
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "ddis?ddi=944048185"
     Then the response status code should be 200
      And the JSON should be equal to:
      """
      [
          {
              "ddi": "944048185",
              "ddie164": "+376944048185",
              "description": null,
              "id": 10,
              "company": 1,
              "ddiProvider": null,
              "country": 1
          }
      ]
      """

  Scenario: Without company nor DDI provider the DDIs are created unassigned
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" multipart request to "/ddis/mass_import" with body:
    """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="country"

68
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="csv"; filename="ddis.csv"
Content-Type: text/csv

944048190
944048191
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
     Then the response status code should be 201
      And the JSON should be equal to:
      """
      {
          "created": 2,
          "updated": 0,
          "skipped": 0,
          "failed": 0,
          "updatedLines": [],
          "skippedRows": [],
          "errors": []
      }
      """

  Scenario: With company only, the DDI is created in the company without DDI provider
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" multipart request to "/ddis/mass_import" with body:
    """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="company"

1
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="country"

68
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="csv"; filename="ddis.csv"
Content-Type: text/csv

944048192
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
     Then the response status code should be 201
      And the JSON should be like:
      """
      {
          "created": 1,
          "*": "~"
      }
      """

  Scenario: With DDI provider only, the DDI is created unassigned with that DDI provider
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" multipart request to "/ddis/mass_import" with body:
    """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="country"

68
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="ddiProvider"

1
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="csv"; filename="ddis.csv"
Content-Type: text/csv

944048193
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
     Then the response status code should be 201
      And the JSON should be like:
      """
      {
          "created": 1,
          "*": "~"
      }
      """

  Scenario: The DDIs created so far have the company and the DDI provider given in each import
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "ddis?ddi[]=944048190&ddi[]=944048192&ddi[]=944048193"
     Then the response status code should be 200
      And the JSON should be equal to:
      """
      [
          {
              "ddi": "944048190",
              "ddie164": "+34944048190",
              "description": null,
              "id": 11,
              "company": null,
              "ddiProvider": null,
              "country": 68
          },
          {
              "ddi": "944048192",
              "ddie164": "+34944048192",
              "description": null,
              "id": 13,
              "company": 1,
              "ddiProvider": null,
              "country": 68
          },
          {
              "ddi": "944048193",
              "ddie164": "+34944048193",
              "description": null,
              "id": 14,
              "company": null,
              "ddiProvider": 1,
              "country": 68
          }
      ]
      """

  Scenario: An outbound only DDI of the company is created through the API
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/ddis" with body:
      """
      {
          "ddi": "944048195",
          "type": "out",
          "company": 1,
          "country": 68
      }
      """
     Then the response status code should be 201
      And the JSON should be like:
      """
      {
          "id": 15,
          "type": "out",
          "ddiProvider": null,
          "*": "~"
      }
      """

  Scenario: Existing DDIs of the brand are completed, conflicts are skipped and repeated or invalid rows are reported
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" multipart request to "/ddis/mass_import" with body:
    """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="company"

1
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="country"

68
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="ddiProvider"

1
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="csv"; filename="ddis.csv"
Content-Type: text/csv

﻿944048190
944048192
  944048193
123
124
127
944048195
944048190
+34944048188
12345678901234567890123456
944048194
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
     Then the response status code should be 201
      And the JSON should be equal to:
      """
      {
          "created": 1,
          "updated": 3,
          "skipped": 5,
          "failed": 2,
          "updatedLines": [
              1,
              2,
              3
          ],
          "skippedRows": [
              {
                  "line": 4,
                  "message": "Nothing to update"
              },
              {
                  "line": 5,
                  "message": "DDI already assigned to another client"
              },
              {
                  "line": 6,
                  "message": "DDI already exists"
              },
              {
                  "line": 7,
                  "message": "Outbound only DDIs cannot have a DDI provider"
              },
              {
                  "line": 8,
                  "message": "Repeated in the file"
              }
          ],
          "errors": [
              {
                  "line": 9,
                  "message": "Value \"+34944048188\" does not match expression."
              },
              {
                  "line": 10,
                  "message": "ddi value \"12345678901234567890123456\" is too long, it should have no more than 25 characters, but has 26 characters."
              }
          ]
      }
      """

  Scenario: The completed DDIs got the missing company or DDI provider and the skipped ones did not change
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "ddis?ddi[]=124&ddi[]=944048190&ddi[]=944048192&ddi[]=944048193&ddi[]=944048194&ddi[]=944048195"
     Then the response status code should be 200
      And the JSON should be equal to:
      """
      [
          {
              "ddi": "124",
              "ddie164": "+34124",
              "description": null,
              "id": 2,
              "company": 4,
              "ddiProvider": 1,
              "country": 68
          },
          {
              "ddi": "944048190",
              "ddie164": "+34944048190",
              "description": null,
              "id": 11,
              "company": 1,
              "ddiProvider": 1,
              "country": 68
          },
          {
              "ddi": "944048192",
              "ddie164": "+34944048192",
              "description": null,
              "id": 13,
              "company": 1,
              "ddiProvider": 1,
              "country": 68
          },
          {
              "ddi": "944048193",
              "ddie164": "+34944048193",
              "description": null,
              "id": 14,
              "company": 1,
              "ddiProvider": 1,
              "country": 68
          },
          {
              "ddi": "944048194",
              "ddie164": "+34944048194",
              "description": null,
              "id": 16,
              "company": 1,
              "ddiProvider": 1,
              "country": 68
          },
          {
              "ddi": "944048195",
              "ddie164": "+34944048195",
              "description": null,
              "id": 15,
              "company": 1,
              "ddiProvider": null,
              "country": 68
          }
      ]
      """

  Scenario: The DDI of another brand did not change
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "ddis?ddi=127"
     Then the response status code should be 200
      And the JSON should be equal to:
      """
      []
      """

  Scenario: Importing the same file again creates and updates nothing
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" multipart request to "/ddis/mass_import" with body:
    """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="company"

1
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="country"

68
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="ddiProvider"

1
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="csv"; filename="ddis.csv"
Content-Type: text/csv

﻿944048190
944048192
  944048193
123
124
127
944048195
944048190
+34944048188
12345678901234567890123456
944048194
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
     Then the response status code should be 201
      And the JSON should be equal to:
      """
      {
          "created": 0,
          "updated": 0,
          "skipped": 9,
          "failed": 2,
          "updatedLines": [],
          "skippedRows": [
              {
                  "line": 1,
                  "message": "Nothing to update"
              },
              {
                  "line": 2,
                  "message": "Nothing to update"
              },
              {
                  "line": 3,
                  "message": "Nothing to update"
              },
              {
                  "line": 4,
                  "message": "Nothing to update"
              },
              {
                  "line": 5,
                  "message": "DDI already assigned to another client"
              },
              {
                  "line": 6,
                  "message": "DDI already exists"
              },
              {
                  "line": 7,
                  "message": "Outbound only DDIs cannot have a DDI provider"
              },
              {
                  "line": 8,
                  "message": "Repeated in the file"
              },
              {
                  "line": 11,
                  "message": "Nothing to update"
              }
          ],
          "errors": [
              {
                  "line": 9,
                  "message": "Value \"+34944048188\" does not match expression."
              },
              {
                  "line": 10,
                  "message": "ddi value \"12345678901234567890123456\" is too long, it should have no more than 25 characters, but has 26 characters."
              }
          ]
      }
      """

  Scenario: An empty file is reported as a file error
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" multipart request to "/ddis/mass_import" with body:
    """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="country"

68
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="csv"; filename="ddis.csv"
Content-Type: text/csv


------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
     Then the response status code should be 201
      And the JSON should be equal to:
      """
      {
          "created": 0,
          "updated": 0,
          "skipped": 0,
          "failed": 1,
          "updatedLines": [],
          "skippedRows": [],
          "errors": [
              {
                  "line": 0,
                  "message": "The file is empty"
              }
          ]
      }
      """
