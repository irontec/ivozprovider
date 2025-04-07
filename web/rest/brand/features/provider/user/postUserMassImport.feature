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
          }
      ]
      """

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
          "success": true,
          "errorMsg": "",
          "failed": 0
      }
    """

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
              "extension": 7,
              "outgoingDdi": 5,
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
              "extension": 6,
              "outgoingDdi": 4,
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
              "ddi": "946002050",
              "ddie164": "+34946002050",
              "description": null,
              "id": 4,
              "company": 1,
              "ddiProvider": 1,
              "country": 68
          },
          {
              "ddi": "946002051",
              "ddie164": "+34946002051",
              "description": null,
              "id": 5,
              "company": 1,
              "ddiProvider": 1,
              "country": 68
          }
      ]
      """
