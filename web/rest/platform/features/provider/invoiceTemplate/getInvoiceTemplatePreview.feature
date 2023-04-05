Feature: Preview invoice templates
  In order to preview invoice templates
  As a super admin
  I need to be able to preview them through the API.

  @createSchema
  Scenario: Preview the invoice templates
    Given I add Authorization header
      And I send a "GET" request to "invoice_templates/2/preview"
     Then the response status code should be 200
      And the response should be equal to:
      """
      <div>
          <p class="bold">Ivoz Provider</p>
          <p class="bold">,  ,  </p>
          <p>NIF / CIF: </p>
      </div><div>
          <div class="clientData">
              <h2>Cliente</h2>
              <p>IRONTEC Internet y Sistemas sobre GNU/Linux S.L.</p>
              <p> Uribitarte 6, 2º</p>
              <p>48001 Bilbao, Bizkaia </p>
              <p>NIF / CIF: B-95274890</p>
          </div>
          <div class="invoiceData">
              <p class="bold">Nº de factura</p>
              <p>667</p>
              <p class="bold">Periodo de facturación</p>
              <p>01/05/2017 - 16/05/2017</p>
          </div>
      </div><body>
          <p id="registryData">
              #
          </p>
          <div id="footer">
            <p>
              <span id="page"></span>
              / <span id="topage"></span>
            </p>
          </div>
          <script>
            var vars = {};
            var query_strings_from_url = document.location.search.substring(1).split('&');
            for (var query_string in query_strings_from_url) {
                if (query_strings_from_url.hasOwnProperty(query_string)) {
                    var temp_var = query_strings_from_url[query_string].split('=', 2);
                    vars[temp_var[0]] = decodeURI(temp_var[1]);
                }
            }
            document.getElementById('page').innerHTML = vars.page;
            document.getElementById('topage').innerHTML = vars.topage;
          </script>
      </body>
      """
