Feature: Update peer servers
  In order to manage peer servers
  As an super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a peer server
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/peer_servers/1" with body:
    """
      {
          "ip": "127.1.0.1",
          "hostname": "hostname.net",
          "port": 5060,
          "params": "",
          "uriScheme": true,
          "transport": true,
          "strip": null,
          "prefix": "",
          "sendPAI": false,
          "sendRPID": false,
          "authNeeded": "no",
          "authUser": null,
          "authPassword": null,
          "sipProxy": "127.0.0.1",
          "outboundProxy": null,
          "fromUser": "",
          "fromDomain": "",
          "peeringContract": 1,
          "brand": 2
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
        {
            "ip": null,
            "hostname": "127.0.0.1",
            "port": 5060,
            "params": "",
            "uriScheme": true,
            "transport": true,
            "strip": null,
            "prefix": "",
            "sendPAI": false,
            "sendRPID": false,
            "authNeeded": "no",
            "authUser": null,
            "authPassword": null,
            "sipProxy": "127.0.0.1",
            "outboundProxy": null,
            "fromUser": "",
            "fromDomain": "",
            "id": 1,
            "peeringContract": {
                "description": "Artemis-Dev",
                "name": "Artemis-Dev",
                "externallyRated": false,
                "id": 1,
                "brand": 1,
                "transformationRuleSet": 1
            },
            "brand": {
                "name": "Irontec_e2e",
                "domainUsers": "sip.irontec.com",
                "recordingsLimitMB": null,
                "recordingsLimitEmail": null,
                "maxCalls": 0,
                "id": 2,
                "logo": {
                    "fileSize": null,
                    "mimeType": null,
                    "baseName": null
                },
                "invoice": {
                    "nif": "",
                    "postalAddress": "",
                    "postalCode": "",
                    "town": "",
                    "province": "",
                    "country": "",
                    "registryData": ""
                },
                "domain": 4,
                "language": 1,
                "defaultTimezone": 1
            }
        }
    """
