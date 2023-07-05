Feature: Retrieve dashboard

  @createSchema
  Scenario: Retrieve platform dashboard json
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "my/dashboard"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "brand": {
              "id": 1,
              "name": "DemoBrand",
              "nif": "",
              "postalCode": "",
              "sipDomain": "",
              "maxCalls": 0
          },
          "recentActivity": [
              {
                  "name": "Residential Company",
                  "type": "residential",
                  "domainUsers": "",
                  "maxCalls": 0
              },
              {
                  "name": "Retail Company",
                  "type": "retail",
                  "domainUsers": "",
                  "maxCalls": 0
              },
              {
                  "name": "Irontec Test Company",
                  "type": "vpbx",
                  "domainUsers": "test.irontec.com",
                  "maxCalls": 0
              },
              {
                  "name": "DemoCompany",
                  "type": "vpbx",
                  "domainUsers": "127.0.0.1",
                  "maxCalls": 0
              }
          ],
          "clientNum": 4,
          "ddiNum": 3,
          "carrierNum": 2
      }
      """
