# The csv responses start with the UTF-8 BOM, present but invisible in the expected text
Feature: Users mass export
  In order to edit the users of a vPBX in bulk or move them to another platform
  As a brand admin
  I need to download a CSV file that the users mass import accepts

  @createSchema
  Scenario: Mass export without company is a bad request
    Given I add Brand Authorization header
     When I add "Accept" header equal to "text/csv"
      And I send a "GET" request to "/users/mass_export"
     Then the response status code should be 400

  Scenario: Mass export of an unknown company is not found
    Given I add Brand Authorization header
     When I add "Accept" header equal to "text/csv"
      And I send a "GET" request to "/users/mass_export?company=999"
     Then the response status code should be 404

  Scenario: Mass export of a non vPBX company is a bad request
    Given I add Brand Authorization header
     When I add "Accept" header equal to "text/csv"
      And I send a "GET" request to "/users/mass_export?company=3"
     Then the response status code should be 400

  Scenario: Mass export of another brand company is forbidden
    Given I add Brand Authorization header
     When I add "Accept" header equal to "text/csv"
      And I send a "GET" request to "/users/mass_export?company=6"
     Then the response status code should be 403

  Scenario: Mass export lists the users of the vPBX in the import format without terminal passwords
    Given I add Brand Authorization header
     When I add "Accept" header equal to "text/csv"
      And I send a "GET" request to "/users/mass_export?company=1"
     Then the response status code should be 200
      And the header "Content-Type" should be equal to "text/csv; charset=utf-8"
      And the streamed response should be equal to:
      """
      ﻿name;lastname;email;"terminal name";"terminal password";"terminal model";mac;extension;"ddi country";"ddi number";"ddi provider"
      Alice;Allison;alice@democompany.com;alice;;Generic;;;ES;121;DDIProviderName
      Bob;Bobson;bob@democompany.com;bob;;Generic;;;;;
      Joe;Doe;joe@democompany.com;testTerminal4;;YealinkT21P_E2;0011223344bb;102;;;
      """

  Scenario: A restricted admin allowed to read the mass import can export
    Given I add restricted Brand Authorization header
     When I add "Accept" header equal to "text/csv"
      And I send a "GET" request to "/users/mass_export?company=1"
     Then the response status code should be 200

  Scenario: Users with quotes, separators, accents and formula like values are imported for the round trip
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" multipart request to "/users/mass_import" with body:
    """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="company"

2
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="csv"; filename="users.csv"
Content-Type: text/csv

"Núñez ""Pepe""","O'Brien; Jr",pepe@import.test,pepe_t21,Zx9*abc123DEF,YealinkT21P_E2,001565aabb11,2101,ES,944000311,DDIProviderName
=Sum,-Dash,dash@import.test,,,,,2102,,,
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
     Then the response status code should be 201
      And the JSON should be equal to:
      """
      {
          "created": 2,
          "updated": 0,
          "errors": []
      }
      """

  Scenario: Exported values are quoted and formula like values are escaped
    Given I add Brand Authorization header
     When I add "Accept" header equal to "text/csv"
      And I send a "GET" request to "/users/mass_export?company=2"
     Then the response status code should be 200
      And the streamed response should be equal to:
      """
      ﻿name;lastname;email;"terminal name";"terminal password";"terminal model";mac;extension;"ddi country";"ddi number";"ddi provider"
      '=Sum;'-Dash;dash@import.test;;;;;2102;;;
      "Núñez ""Pepe""";"O'Brien; Jr";pepe@import.test;pepe_t21;;YealinkT21P_E2;001565aabb11;2101;ES;944000311;DDIProviderName
      """

  Scenario: Importing the exported file again changes nothing
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" multipart request to "/users/mass_import" with body:
    """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="company"

2
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="csv"; filename="users.csv"
Content-Type: text/csv

﻿name;lastname;email;"terminal name";"terminal password";"terminal model";mac;extension;"ddi country";"ddi number";"ddi provider"
"Núñez ""Pepe""";"O'Brien; Jr";pepe@import.test;pepe_t21;;YealinkT21P_E2;001565aabb11;2101;ES;944000311;DDIProviderName
'=Sum;'-Dash;dash@import.test;;;;;2102;;;
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
     Then the response status code should be 201
      And the JSON should be equal to:
      """
      {
          "created": 0,
          "updated": 2,
          "errors": []
      }
      """

  Scenario: The reimported users keep their names and relations
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "users?company=2"
     Then the response status code should be 200
      And the JSON should be like:
      """
      [
          {
              "name": "=Sum",
              "lastname": "-Dash",
              "email": "dash@import.test",
              "active": false,
              "id": 5,
              "company": 2,
              "terminal": null,
              "extension": 9,
              "outgoingDdi": null,
              "location": null,
              "status": []
          },
          {
              "name": "Núñez \"Pepe\"",
              "lastname": "O'Brien; Jr",
              "email": "pepe@import.test",
              "active": false,
              "id": 4,
              "company": 2,
              "terminal": 5,
              "extension": 8,
              "outgoingDdi": 7,
              "location": null,
              "status": []
          }
      ]
      """

  Scenario: Importing the exported file with one edited cell changes only that value
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" multipart request to "/users/mass_import" with body:
    """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="company"

2
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="csv"; filename="users.csv"
Content-Type: text/csv

﻿name;lastname;email;"terminal name";"terminal password";"terminal model";mac;extension;"ddi country";"ddi number";"ddi provider"
"Núñez ""Pepe""";"O'Brien; Jr";pepe.edited@import.test;pepe_t21;;YealinkT21P_E2;001565aabb11;2101;ES;944000311;DDIProviderName
'=Sum;'-Dash;dash@import.test;;;;;2102;;;
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
     Then the response status code should be 201
      And the JSON should be equal to:
      """
      {
          "created": 0,
          "updated": 2,
          "errors": []
      }
      """

  Scenario: Only the edited email changed
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "users?company=2"
     Then the response status code should be 200
      And the JSON should be like:
      """
      [
          {
              "name": "=Sum",
              "lastname": "-Dash",
              "email": "dash@import.test",
              "active": false,
              "id": 5,
              "company": 2,
              "terminal": null,
              "extension": 9,
              "outgoingDdi": null,
              "location": null,
              "status": []
          },
          {
              "name": "Núñez \"Pepe\"",
              "lastname": "O'Brien; Jr",
              "email": "pepe.edited@import.test",
              "active": false,
              "id": 4,
              "company": 2,
              "terminal": 5,
              "extension": 8,
              "outgoingDdi": 7,
              "location": null,
              "status": []
          }
      ]
      """

  Scenario: Importing an exported file into another vPBX rejects the rows that keep DDIs or MACs of the original client
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" multipart request to "/users/mass_import" with body:
    """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="company"

2
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="csv"; filename="DemoCompany-users.csv"
Content-Type: text/csv

﻿name;lastname;email;"terminal name";"terminal password";"terminal model";mac;extension;"ddi country";"ddi number";"ddi provider"
Alice;Allison;;alice;;Generic;;;ES;121;DDIProviderName
Bob;Bobson;;bob;;Generic;;;;;
Joe;Doe;;testTerminal4;;YealinkT21P_E2;0011223344bb;102;;;
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
     Then the response status code should be 201
      And the JSON should be equal to:
      """
      {
          "created": 1,
          "updated": 0,
          "errors": [
              {
                  "line": 2,
                  "message": "DDI already exists in another company"
              },
              {
                  "line": 4,
                  "message": "Mac already exists in another company's terminal"
              }
          ]
      }
      """
