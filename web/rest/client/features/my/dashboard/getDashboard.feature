Feature: Retrieve dashboard

  @createSchema
  Scenario: Retrieve vpbx dashboard json
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "my/dashboard"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "client": {
              "name": "DemoCompany",
              "nif": "12345678A",
              "postalCode": "54321",
              "domainUsers": "127.0.0.1",
              "maxCalls": 0
          },
          "latestBillableCalls": [],
          "latestUsers": [
              {
                  "name": "Joe",
                  "lastName": "Doe",
                  "extension": "102",
                  "outgoingDdi": ""
              },
              {
                  "name": "Bob",
                  "lastName": "Bobson",
                  "extension": "",
                  "outgoingDdi": ""
              },
              {
                  "name": "Alice",
                  "lastName": "Allison",
                  "extension": "",
                  "outgoingDdi": "121"
              }
          ],
          "latestResidentialDevices": [],
          "latestRetailAccounts": [],
          "userNum": 3,
          "extensionNum": 7,
          "ddiNum": 3,
          "residentialDeviceNum": null,
          "voiceMailNum": null,
          "retailsAccountNum": null
      }
      """

  Scenario: Retrieve retail dashboard json
    Given I add Retail Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "my/dashboard"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "client": {
              "name": "Retail Company",
              "nif": "12345679-Z",
              "postalCode": "",
              "domainUsers": null,
              "maxCalls": 0
          },
          "latestBillableCalls": [],
          "latestUsers": [],
          "latestResidentialDevices": [],
          "latestRetailAccounts": [
              {
                  "name": "testRetailAccount6",
                  "outgoingDdi": "",
                  "description": ""
              },
              {
                  "name": "testRetailAccount",
                  "outgoingDdi": "",
                  "description": ""
              }
          ],
          "userNum": null,
          "extensionNum": null,
          "ddiNum": 1,
          "residentialDeviceNum": null,
          "voiceMailNum": null,
          "retailsAccountNum": 2
      }
      """

  Scenario: Retrieve residential dashboard json
    Given I add Residential Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "my/dashboard"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "client": {
              "name": "Residential Company",
              "nif": "12345679-Z",
              "postalCode": "",
              "domainUsers": null,
              "maxCalls": 0
          },
          "latestBillableCalls": [],
          "latestUsers": [],
          "latestResidentialDevices": [
              {
                  "name": "residentialDevice",
                  "outgoingDdi": "",
                  "description": ""
              },
              {
                  "name": "residentialDevice6",
                  "outgoingDdi": "",
                  "description": ""
              }
          ],
          "latestRetailAccounts": [],
          "userNum": null,
          "extensionNum": null,
          "ddiNum": 1,
          "residentialDeviceNum": 2,
          "voiceMailNum": 1,
          "retailsAccountNum": null
      }
      """

  Scenario: Retrieve wholesale dashboard json
    Given I add Wholesale Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "my/dashboard"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "client": {
              "name": "Wholesale Company",
              "nif": "12345689-Z",
              "postalCode": "",
              "domainUsers": "wholesale.irontec.com",
              "maxCalls": 0
          },
          "latestBillableCalls": [
              {
                  "startTime": "2019-01-01T08:01:40+00:00",
                  "caller": "+34633646464",
                  "callee": "+34633656565",
                  "duration": 0
              },
              {
                  "startTime": "2019-01-01T08:01:41+00:00",
                  "caller": "+34633646464",
                  "callee": "+34633656565",
                  "duration": 0
              },
              {
                  "startTime": "2019-01-01T08:01:42+00:00",
                  "caller": "+34633646464",
                  "callee": "+34633656565",
                  "duration": 0
              },
              {
                  "startTime": "2019-01-01T08:01:43+00:00",
                  "caller": "+34633646464",
                  "callee": "+34633656565",
                  "duration": 0
              }
          ],
          "latestUsers": [],
          "latestResidentialDevices": [],
          "latestRetailAccounts": [],
          "userNum": null,
          "extensionNum": null,
          "ddiNum": null,
          "residentialDeviceNum": null,
          "voiceMailNum": null,
          "retailsAccountNum": null
      }
      """
