Feature: Retrieve invoice template
  In order to manage Invoice Templates
  as a super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the invoice templates json list
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "invoice_templates"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "name": "Generic",
              "description": "Generic invoice template",
              "id": 2
          }
      ]
      """

  Scenario: Retrieve certain invoice template json
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "invoice_templates/2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "name": "Generic",
          "description": "Generic invoice template",
          "template": "<div>\n    <div class=\"clientData\">\n        <h2>Cliente</h2>\n        <p>{{company.name}}</p>\n        <p>{{company.postalAddress}}</p>\n        <p>{{company.postalCode}} {{company.town}}, {{company.province}} </p>\n        <p>NIF / CIF: {{company.nif}}</p>\n    </div>\n    <div class=\"invoiceData\">\n        <p class=\"bold\">Nº de factura</p>\n        <p>{{invoice.number}}</p>\n        <p class=\"bold\">Periodo de facturación</p>\n        <p>{{invoice.inDate}} - {{invoice.outDate}}</p>\n    </div>\n</div>",
          "templateHeader": "<div>\n    <p class=\"bold\">{{brand.name}}</p>\n    <p class=\"bold\">{{brand.invoice.postalAddress}}, {{brand.invoice.postalCode}} {{brand.invoice.town}}, {{brand.invoice.province}} </p>\n    <p>NIF / CIF: {{brand.invoice.nif}}</p>\n</div>",
          "templateFooter": "<body>\n    <p id=\"registryData\">\n        #{{brand.invoice.registryData}}\n    </p>\n    <div id=\"footer\">\n      <p>\n        <span id=\"page\"></span>\n        / <span id=\"topage\"></span>\n      </p>\n    </div>\n    <script>\n      var vars = {};\n      var query_strings_from_url = document.location.search.substring(1).split('&');\n      for (var query_string in query_strings_from_url) {\n          if (query_strings_from_url.hasOwnProperty(query_string)) {\n              var temp_var = query_strings_from_url[query_string].split('=', 2);\n              vars[temp_var[0]] = decodeURI(temp_var[1]);\n          }\n      }\n      document.getElementById('page').innerHTML = vars.page;\n      document.getElementById('topage').innerHTML = vars.topage;\n    </script>\n</body>",
          "id": 2,
          "brand": null
      }
      """
