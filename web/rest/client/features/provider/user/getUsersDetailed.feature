Feature: Retrieve users detailed list
  In order to manage users
  As a client admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the users json list
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "users/detailed"
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
                "id": 1,
                "terminal": {
                    "name": "alice",
                    "disallow": "all",
                    "allowAudio": "alaw",
                    "allowVideo": null,
                    "directMediaMethod": "invite",
                    "password": "AUfVkn498_",
                    "mac": null,
                    "lastProvisionDate": null,
                    "t38Passthrough": "no",
                    "rtpEncryption": false,
                    "id": 1,
                    "terminalModel": 1
                },
                "extension": null,
                "location": {
                    "name": "testLocation",
                    "description": "Test Location description",
                    "id": 1,
                    "survivalDevice": 1,
                    "userIds": []
                }
            },
            {
                "name": "Bob",
                "lastname": "Bobson",
                "email": "bob@democompany.com",
                "id": 2,
                "terminal": {
                    "name": "bob",
                    "disallow": "all",
                    "allowAudio": "alaw",
                    "allowVideo": null,
                    "directMediaMethod": "invite",
                    "password": "fLgQYa6-57",
                    "mac": null,
                    "lastProvisionDate": null,
                    "t38Passthrough": "no",
                    "rtpEncryption": false,
                    "id": 2,
                    "terminalModel": 1
                },
                "extension": null,
                "location": {
                    "name": "testLocation",
                    "description": "Test Location description",
                    "id": 1,
                    "survivalDevice": 1,
                    "userIds": []
                }
            },
            {
                "name": "Joe",
                "lastname": "Doe",
                "email": "joe@democompany.com",
                "id": 3,
                "terminal": {
                    "name": "testTerminal4",
                    "disallow": "all",
                    "allowAudio": "alaw",
                    "allowVideo": null,
                    "directMediaMethod": "invite",
                    "password": "fLgQYa6-57",
                    "mac": "0011223344bb",
                    "lastProvisionDate": null,
                    "t38Passthrough": "no",
                    "rtpEncryption": false,
                    "id": 4,
                    "terminalModel": 2
                },
                "extension": {
                    "number": "102",
                    "routeType": "user",
                    "numberValue": null,
                    "friendValue": null,
                    "id": 2,
                    "ivr": null,
                    "huntGroup": null,
                    "conferenceRoom": null,
                    "user": 2,
                    "queue": null,
                    "conditionalRoute": null,
                    "numberCountry": null,
                    "voicemail": null,
                    "locution": null
                },
                "location": {
                    "name": "testLocation",
                    "description": "Test Location description",
                    "id": 1,
                    "survivalDevice": 1,
                    "userIds": []
                }
            }
      ]
      """
