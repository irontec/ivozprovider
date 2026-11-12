Feature: Create users
	In order to manage users
	As a brand admin
	I need to be able to create them through the API.

	@createSchema
	Scenario: Retrieve the user json list
		Given I add Brand Authorization header
		When I add "Accept" header equal to "application/json"
		And I send a "GET" request to "users"
		Then the response status code should be 200
		And the response should be in JSON
		And the header "Content-Type" should be equal to "application/json; charset=utf-8"
		And the JSON should be equal to:
      """
      [
          {
              "name": "Alice",
              "lastname": "Allison",
              "email": "alice@democompany.com",
              "active": true,
              "id": 1,
              "company": 1,
              "terminal": 1,
              "extension": null,
              "outgoingDdi": 3,
              "location": 1,
              "status": [
                  {
                      "contact": "sip:yealinktest@10.10.1.106:5060",
                      "received": "sip:212.64.172.23:5060",
                      "publicReceived": true,
                      "expires": "2031-01-01 00:59:59",
                      "userAgent": "Yealink SIP-T23G 44.80.0.130"
                  }
              ]
          },
          {
              "name": "Bob",
              "lastname": "Bobson",
              "email": "bob@democompany.com",
              "active": true,
              "id": 2,
              "company": 1,
              "terminal": 2,
              "extension": null,
              "outgoingDdi": null,
              "location": 1,
              "status": []
          },
          {
              "name": "Joe",
              "lastname": "Doe",
              "email": "joe@democompany.com",
              "active": true,
              "id": 3,
              "company": 1,
              "terminal": 4,
              "extension": 2,
              "outgoingDdi": null,
              "location": 1,
              "status": []
          }
      ]
      """

	Scenario: Retrieve the ddi json list
		Given I add Brand Authorization header
		When I add "Accept" header equal to "application/json"
		And I send a "GET" request to "ddis"
		Then the response status code should be 200
		And the response should be in JSON
		And the header "Content-Type" should be equal to "application/json; charset=utf-8"
		And the JSON should be equal to:
      """
      [
          {
              "ddi": "121",
              "ddie164": "+34121",
              "description": null,
              "id": 3,
              "company": 3,
              "ddiProvider": 1,
              "country": 68
          },
          {
              "ddi": "123",
              "ddie164": "+34123",
              "description": "Description for DDI 123",
              "id": 1,
              "company": 1,
              "ddiProvider": 1,
              "country": 68
          },
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
              "ddi": "125",
              "ddie164": "+34125",
              "description": null,
              "id": 4,
              "company": 1,
              "ddiProvider": 1,
              "country": 68
          },
          {
              "ddi": "126",
              "ddie164": "+34126",
              "description": null,
              "id": 5,
              "company": 1,
              "ddiProvider": 1,
              "country": 68
          }
      ]
      """

	Scenario: A read only admin cannot mass import users
		Given I add restricted Brand Authorization header
		When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
		And I add "Accept" header equal to "application/json"
		And I send a "POST" multipart request to "/users/mass_import" with body:
        """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="company"

1
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="csv"; filename="massImport.csv"
Content-Type: text/csv

Forbidden,User,forbidden@irontec.com,,,,,,,,
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
		Then the response status code should be 403

	Scenario: Mass import does not accept GET requests
		Given I add Brand Authorization header
		When I add "Accept" header equal to "application/json"
		And I send a "GET" request to "/users/mass_import"
		Then the response status code should be 405

	Scenario: Mass import without csv file is a bad request
		Given I add Brand Authorization header
		When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
		And I add "Accept" header equal to "application/json"
		And I send a "POST" multipart request to "/users/mass_import" with body:
        """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="company"

1
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
		Then the response status code should be 400

	Scenario: Mass import into an unknown company is not found
		Given I add Brand Authorization header
		When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
		And I add "Accept" header equal to "application/json"
		And I send a "POST" multipart request to "/users/mass_import" with body:
        """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="company"

99999
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="csv"; filename="massImport.csv"
Content-Type: text/csv

Unknown,Company,unknown@irontec.com,,,,,,,,
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
		Then the response status code should be 404

	Scenario: Mass import into a non vPBX company is a bad request
		Given I add Brand Authorization header
		When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
		And I add "Accept" header equal to "application/json"
		And I send a "POST" multipart request to "/users/mass_import" with body:
        """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="company"

3
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="csv"; filename="massImport.csv"
Content-Type: text/csv

Retail,User,retail@irontec.com,,,,,,,,
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
		Then the response status code should be 400

	Scenario: Mass import into another brand company is forbidden
		Given I add Brand Authorization header
		When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
		And I add "Accept" header equal to "application/json"
		And I send a "POST" multipart request to "/users/mass_import" with body:
        """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="company"

6
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="csv"; filename="massImport.csv"
Content-Type: text/csv

Other,Brand,otherbrand@irontec.com,,,,,,,,
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
		Then the response status code should be 403

	@createSchema
	Scenario: A row without terminal after a row with terminal does not inherit it
		Given I add Brand Authorization header
		When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
		And I add "Accept" header equal to "application/json"
		And I send a "POST" multipart request to "/users/mass_import" with body:
        """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="company"

1
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="csv"; filename="massImport.csv"
Content-Type: text/csv

Alone,User,alone@irontec.com,aloneTerminal,Z7+KJn8m3k,YealinkT21P_E2,a00000000060,2010,ES,946002060,DDIProviderName
NoTerminal,User,noterminal@irontec.com,,,,,,,,
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
		Then the response status code should be 201
		And the JSON node "errors" should have 0 elements

	Scenario: The user imported without terminal has no terminal, extension nor outgoing ddi
		Given I add Brand Authorization header
		When I add "Accept" header equal to "application/json"
		And I send a "GET" request to "users?email[exact]=noterminal@irontec.com"
		Then the response status code should be 200
		And the JSON node "root[0].name" should be equal to the string "NoTerminal"
		And the JSON node "root[0].terminal" should be null
		And the JSON node "root[0].extension" should be null
		And the JSON node "root[0].outgoingDdi" should be null

	Scenario: An extension that belongs to another user fails that row
		Given I add Brand Authorization header
		When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
		And I add "Accept" header equal to "application/json"
		And I send a "POST" multipart request to "/users/mass_import" with body:
        """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="company"

1
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="csv"; filename="massImport.csv"
Content-Type: text/csv

Thief,User,thief@irontec.com,,,,,2010,,,
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
		Then the response status code should be 201
		And the JSON node "errors" should have 1 element
		And the JSON node "errors[0].message" should match "/another user/"

	Scenario: The extension keeps its original user
		Given I add Brand Authorization header
		When I add "Accept" header equal to "application/json"
		And I send a "GET" request to "users?email[exact]=alone@irontec.com"
		Then the response status code should be 200
		And the JSON node "root[0].extension" should not be null
		And the JSON node "root[0].terminal" should not be null

	Scenario: An extension routed to something else fails that row
		Given I add Brand Authorization header
		When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
		And I add "Accept" header equal to "application/json"
		And I send a "POST" multipart request to "/users/mass_import" with body:
        """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="company"

1
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="csv"; filename="massImport.csv"
Content-Type: text/csv

Locution,Thief,locution-thief@irontec.com,,,,,999,,,
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
		Then the response status code should be 201
		And the JSON node "created" should be equal to 0
		And the JSON node "errors" should have 1 element
		And the JSON node "errors[0].message" should be equal to "Extension 999 is already routed to a locution"

	Scenario: The locution extension keeps its routing
		Given I add Brand Authorization header
		When I add "Accept" header equal to "application/json"
		And I send a "GET" request to "extensions?number[exact]=999"
		Then the response status code should be 200
		And the JSON node "root[0].routeType" should be equal to "locution"

	Scenario: A new name with the email of a user of the client updates that user
		Given I add Brand Authorization header
		When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
		And I add "Accept" header equal to "application/json"
		And I send a "POST" multipart request to "/users/mass_import" with body:
        """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="company"

1
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="csv"; filename="massImport.csv"
Content-Type: text/csv

Alice,Alison,alice@democompany.com,,,,,,,,
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
		Then the response status code should be 201
		And the JSON should be equal to:
      """
      {
          "created": 0,
          "updated": 1,
          "errors": []
      }
      """

	Scenario: The owner of the email gets the corrected lastname
		Given I add Brand Authorization header
		When I add "Accept" header equal to "application/json"
		And I send a "GET" request to "users?email[exact]=alice@democompany.com"
		Then the response status code should be 200
		And the JSON should be like:
      """
      [
          {
              "name": "Alice",
              "lastname": "Alison",
              "email": "alice@democompany.com",
              "active": true,
              "id": 1,
              "company": 1,
              "terminal": "~",
              "extension": "~",
              "outgoingDdi": "~",
              "location": "~",
              "status": [
                  {
                      "contact": "sip:yealinktest@10.10.1.106:5060",
                      "received": "sip:212.64.172.23:5060",
                      "publicReceived": true,
                      "expires": "2031-01-01 00:59:59",
                      "userAgent": "Yealink SIP-T23G 44.80.0.130"
                  }
              ]
          }
      ]
      """

	Scenario: Importing the previous lastname finds the user by email again
		Given I add Brand Authorization header
		When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
		And I add "Accept" header equal to "application/json"
		And I send a "POST" multipart request to "/users/mass_import" with body:
        """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="company"

1
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="csv"; filename="massImport.csv"
Content-Type: text/csv

Alice,Allison,alice@democompany.com,,,,,,,,
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
		Then the response status code should be 201
		And the JSON should be equal to:
      """
      {
          "created": 0,
          "updated": 1,
          "errors": []
      }
      """

	Scenario: A failed row leaves no change behind even when later rows are imported
		Given I add Brand Authorization header
		When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
		And I add "Accept" header equal to "application/json"
		And I send a "POST" multipart request to "/users/mass_import" with body:
        """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="company"

1
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="csv"; filename="massImport.csv"
Content-Type: text/csv

Alone,User,alone-changed@irontec.com,,,,,,ES,946002061,NoSuchProvider
AfterFailure,User,afterfailure@irontec.com,,,,,,,,
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
		Then the response status code should be 201
		And the JSON node "errors" should have 1 element
		And the JSON node "errors[0].line" should be equal to the number 1
		And the JSON node "created" should be equal to the number 1

	Scenario: The user of the failed row keeps its email
		Given I add Brand Authorization header
		When I add "Accept" header equal to "application/json"
		And I send a "GET" request to "users?email[exact]=alone@irontec.com"
		Then the response status code should be 200
		And the JSON node "root[0].name" should be equal to the string "Alone"
		And the JSON node "root[0].email" should be equal to the string "alone@irontec.com"
		And the JSON node "root[0].terminal" should not be null

	Scenario: The user of the failed row has no trace of the rejected email
		Given I add Brand Authorization header
		When I add "Accept" header equal to "application/json"
		And I send a "GET" request to "users?email[exact]=alone-changed@irontec.com"
		Then the response status code should be 200
		And the JSON should be equal to:
		"""
		[]
		"""

	Scenario: An email that belongs to a user of another client fails that row
		Given I add Brand Authorization header
		When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
		And I add "Accept" header equal to "application/json"
		And I send a "POST" multipart request to "/users/mass_import" with body:
        """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="company"

2
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="csv"; filename="massImport.csv"
Content-Type: text/csv

Alice,Clone,alice@democompany.com,,,,,,,,
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
		Then the response status code should be 201
		And the JSON node "errors" should have 1 element
		And the JSON node "errors[0].line" should be equal to the number 1
		And the JSON node "errors[0].message" should match "/another client/"
		And the JSON node "created" should be equal to the number 0

	Scenario: The user of the other client is left untouched
		Given I add Brand Authorization header
		When I add "Accept" header equal to "application/json"
		And I send a "GET" request to "users?email[exact]=alice@democompany.com"
		Then the response status code should be 200
		And the JSON node "root" should have 1 element
		And the JSON node "root[0].name" should be equal to the string "Alice"
		And the JSON node "root[0].lastname" should be equal to the string "Allison"
		And the JSON node "root[0].company" should be equal to the number 1

	@createSchema
	Scenario: Excel style files with semicolons, BOM and header are accepted
		Given I add Brand Authorization header
		When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
		And I add "Accept" header equal to "application/json"
		And I send a "POST" multipart request to "/users/mass_import" with body:
        """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="company"

1
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="csv"; filename="massImport.csv"
Content-Type: text/csv

﻿name;lastname;email;terminal name;terminal password;terminal model;mac;extension;ddi country;ddi number;ddi provider
Semi;Colon;semi@irontec.com;semiTerminal;Z7+KJn8m3k;YealinkT21P_E2;a00000000070;2020;;;
;;;;;;;;;;
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
		Then the response status code should be 201
		And the JSON node "errors" should have 0 elements
		And the JSON node "created" should be equal to the number 1

	Scenario: The user imported from the Excel style file has a clean name
		Given I add Brand Authorization header
		When I add "Accept" header equal to "application/json"
		And I send a "GET" request to "users?email[exact]=semi@irontec.com"
		Then the response status code should be 200
		And the JSON node "root[0].name" should be equal to the string "Semi"
		And the JSON node "root[0].terminal" should not be null
		And the JSON node "root[0].extension" should not be null

	Scenario: An empty file is reported as a file error
		Given I add Brand Authorization header
		When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
		And I add "Accept" header equal to "application/json"
		And I send a "POST" multipart request to "/users/mass_import" with body:
        """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="company"

1
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="csv"; filename="massImport.csv"
Content-Type: text/csv

------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
		Then the response status code should be 201
		And the JSON node "errors" should have 1 element
		And the JSON node "errors[0].line" should be equal to the number 0
		And the JSON node "errors[0].message" should be equal to the string "The file is empty"

	@createSchema
	Scenario: Users mass import
		Given I add Brand Authorization header
		When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
		And I add "Accept" header equal to "application/json"
		And I send a "POST" multipart request to "/users/mass_import" with body:
        """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="company"

1
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="csv"; filename="massImport.csv"
Content-Type: text/csv

Name,Lastname,name@irontec.com,terminalName,Z7+KJn8m3k,YealinkT21P_E2,a00000000052,2002,ES,946002050,DDIProviderName
John,Doe,jon@irontec.com,terminalName2,Z7+KJn8m3k,YealinkT21P_E2,a00000000053,2003,ES,946002051,DDIProviderName
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
		Then the response status code should be 201
		And the response should be in JSON
		And the header "Content-Type" should be equal to "application/json; charset=utf-8"
		And the JSON should be equal to:
    """
      {
          "created": 2,
          "updated": 0,
          "errors": []
      }
    """

	Scenario: Reimporting the same file changes nothing and creates no duplicates
		Given I add Brand Authorization header
		When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
		And I add "Accept" header equal to "application/json"
		And I send a "POST" multipart request to "/users/mass_import" with body:
        """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="company"

1
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="csv"; filename="massImport.csv"
Content-Type: text/csv

Name,Lastname,name@irontec.com,terminalName,Z7+KJn8m3k,YealinkT21P_E2,a00000000052,2002,ES,946002050,DDIProviderName
John,Doe,jon@irontec.com,terminalName2,Z7+KJn8m3k,YealinkT21P_E2,a00000000053,2003,ES,946002051,DDIProviderName
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

	Scenario: Reimporting with empty terminal columns keeps the terminal values
		Given I add Brand Authorization header
		When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
		And I add "Accept" header equal to "application/json"
		And I send a "POST" multipart request to "/users/mass_import" with body:
        """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="company"

1
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="csv"; filename="massImport.csv"
Content-Type: text/csv

Name,Lastname,,terminalName,,,,,,,
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
		Then the response status code should be 201
		And the JSON should be equal to:
    """
      {
          "created": 0,
          "updated": 1,
          "errors": []
      }
    """

	Scenario: A MAC that belongs to another terminal fails that row
		Given I add Brand Authorization header
		When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
		And I add "Accept" header equal to "application/json"
		And I send a "POST" multipart request to "/users/mass_import" with body:
        """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="company"

1
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="csv"; filename="massImport.csv"
Content-Type: text/csv

Name,Lastname,,terminalName,,,a00000000053,,,,
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
		Then the response status code should be 201
		And the JSON should be equal to:
    """
      {
          "created": 0,
          "updated": 0,
          "errors": [
              {
                  "line": 1,
                  "message": "MAC a00000000053 already belongs to terminal terminalName2"
              }
          ]
      }
    """

	Scenario: The terminal keeps its MAC
		Given I add Brand Authorization header
		When I add "Accept" header equal to "application/json"
		And I send a "GET" request to "terminals?name[exact]=terminalName"
		Then the response status code should be 200
		And the JSON node "root" should have 1 element
		And the JSON node "root[0].mac" should be equal to "a00000000052"

	Scenario: Retrieve the user json list
		Given I add Brand Authorization header
		When I add "Accept" header equal to "application/json"
		And I send a "GET" request to "users"
		Then the response status code should be 200
		And the response should be in JSON
		And the header "Content-Type" should be equal to "application/json; charset=utf-8"
		And the JSON should be equal to:
      """
      [
          {
              "name": "Alice",
              "lastname": "Allison",
              "email": "alice@democompany.com",
              "active": true,
              "id": 1,
              "company": 1,
              "terminal": 1,
              "extension": null,
              "outgoingDdi": 3,
              "location": 1,
              "status": [
                  {
                      "contact": "sip:yealinktest@10.10.1.106:5060",
                      "received": "sip:212.64.172.23:5060",
                      "publicReceived": true,
                      "expires": "2031-01-01 00:59:59",
                      "userAgent": "Yealink SIP-T23G 44.80.0.130"
                  }
              ]
          },
          {
              "name": "Bob",
              "lastname": "Bobson",
              "email": "bob@democompany.com",
              "active": true,
              "id": 2,
              "company": 1,
              "terminal": 2,
              "extension": null,
              "outgoingDdi": null,
              "location": 1,
              "status": []
          },
          {
              "name": "Joe",
              "lastname": "Doe",
              "email": "joe@democompany.com",
              "active": true,
              "id": 3,
              "company": 1,
              "terminal": 4,
              "extension": 2,
              "outgoingDdi": null,
              "location": 1,
              "status": []
          },
          {
              "name": "John",
              "lastname": "Doe",
              "email": "jon@irontec.com",
              "active": false,
              "id": 5,
              "company": 1,
              "terminal": 6,
              "extension": 9,
              "outgoingDdi": 7,
              "location": 1,
              "status": []
          },
          {
              "name": "Name",
              "lastname": "Lastname",
              "email": "name@irontec.com",
              "active": false,
              "id": 4,
              "company": 1,
              "terminal": 5,
              "extension": 8,
              "outgoingDdi": 6,
              "location": 1,
              "status": []
          }
      ]
      """

	Scenario: Retrieve the ddi json list
		Given I add Brand Authorization header
		When I add "Accept" header equal to "application/json"
		And I send a "GET" request to "ddis"
		Then the response status code should be 200
		And the response should be in JSON
		And the header "Content-Type" should be equal to "application/json; charset=utf-8"
		And the JSON should be equal to:
      """
      [
          {
              "ddi": "121",
              "ddie164": "+34121",
              "description": null,
              "id": 3,
              "company": 3,
              "ddiProvider": 1,
              "country": 68
          },
          {
              "ddi": "123",
              "ddie164": "+34123",
              "description": "Description for DDI 123",
              "id": 1,
              "company": 1,
              "ddiProvider": 1,
              "country": 68
          },
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
              "ddi": "125",
              "ddie164": "+34125",
              "description": null,
              "id": 4,
              "company": 1,
              "ddiProvider": 1,
              "country": 68
          },
          {
              "ddi": "126",
              "ddie164": "+34126",
              "description": null,
              "id": 5,
              "company": 1,
              "ddiProvider": 1,
              "country": 68
          },
          {
              "ddi": "946002050",
              "ddie164": "+34946002050",
              "description": null,
              "id": 6,
              "company": 1,
              "ddiProvider": 1,
              "country": 68
          },
          {
              "ddi": "946002051",
              "ddie164": "+34946002051",
              "description": null,
              "id": 7,
              "company": 1,
              "ddiProvider": 1,
              "country": 68
          }
      ]
      """

	@createSchema
	Scenario: The CSV example of the documentation imports as is
		Given I add Brand Authorization header
		When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
		And I add "Accept" header equal to "application/json"
		And I send a "POST" multipart request to "/users/mass_import" with body:
        """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="company"

1
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="csv"; filename="vpbx-users.csv"
Content-Type: text/csv

name,lastname,email,terminal name,terminal password,terminal model,mac,extension,ddi country,ddi number,ddi provider
Alice,Allison,alice@example.com,alice_t21,Zx9*abc123DEF,YealinkT21P_E2,001565aabbcc,301,ES,944000301,
Bob,Bobson,bob@example.com,bob_t21,,YealinkT21P_E2,,302,,,
Carol,Smith,carol@example.com,,,,,,,,
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
		Then the response status code should be 201
		And the JSON should be equal to:
		"""
		{
		    "created": 1,
		    "updated": 2,
		    "errors": []
		}
		"""

	Scenario: An existing user gets the terminal and outgoing ddi created by the import
		Given I add Brand Authorization header
		When I add "Accept" header equal to "application/json"
		And I send a "GET" request to "users?email[exact]=alice@example.com"
		Then the response status code should be 200
		And the JSON node "root[0].name" should be equal to the string "Alice"
		And the JSON node "root[0].terminal" should not be null
		And the JSON node "root[0].extension" should not be null
		And the JSON node "root[0].outgoingDdi" should not be null

	Scenario: A terminal of another client of the brand owns a MAC
		Given I add Brand Authorization header
		When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
		And I add "Accept" header equal to "application/json"
		And I send a "POST" multipart request to "/users/mass_import" with body:
        """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="company"

2
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="csv"; filename="massImport.csv"
Content-Type: text/csv

Foreign,Owner,,foreignTerminal,,,a00000000099,,,,
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
		Then the response status code should be 201
		And the JSON should be equal to:
      """
      {
          "created": 1,
          "updated": 0,
          "errors": []
      }
      """

	Scenario: The user of the other client moves to a new terminal and leaves the MAC owner without user
		Given I add Brand Authorization header
		When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
		And I add "Accept" header equal to "application/json"
		And I send a "POST" multipart request to "/users/mass_import" with body:
        """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="company"

2
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="csv"; filename="massImport.csv"
Content-Type: text/csv

Foreign,Owner,,foreignTerminal2,,,,,,,
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
		Then the response status code should be 201
		And the JSON should be equal to:
      """
      {
          "created": 0,
          "updated": 1,
          "errors": []
      }
      """

	Scenario: A new terminal name with the MAC of another client's terminal fails that row
		Given I add Brand Authorization header
		When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
		And I add "Accept" header equal to "application/json"
		And I send a "POST" multipart request to "/users/mass_import" with body:
        """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="company"

1
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="csv"; filename="massImport.csv"
Content-Type: text/csv

Hijack,Attempt,,hijackTerminal,,,a00000000099,,,,
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
		Then the response status code should be 201
		And the JSON should be equal to:
      """
      {
          "created": 0,
          "updated": 0,
          "errors": [
              {
                  "line": 1,
                  "message": "Mac already exists in another company's terminal"
              }
          ]
      }
      """

	Scenario: The terminal of the other client keeps its name, MAC and domain
		Given I add Brand Authorization header
		When I add "Accept" header equal to "application/json"
		And I send a "GET" request to "terminals?name[exact]=foreignTerminal"
		Then the response status code should be 200
		And the JSON should be like:
      """
      [
          {
              "name": "foreignTerminal",
              "mac": "a00000000099",
              "lastProvisionDate": null,
              "id": "~",
              "domain": 5,
              "status": []
          }
      ]
      """

	Scenario: No terminal was created or renamed for the failed row
		Given I add Brand Authorization header
		When I add "Accept" header equal to "application/json"
		And I send a "GET" request to "terminals?name[exact]=hijackTerminal"
		Then the response status code should be 200
		And the JSON should be equal to:
      """
      []
      """
