import CompaniesItem from '../../../fixtures/Provider/Companies/VirtualPbxs/getItem.json';
import DdiItem from '../../../fixtures/Provider/Ddis/getItem.json';
import ddisMassImport from '../../../fixtures/Provider/Ddis/massImport.json';
import newDdi from '../../../fixtures/Provider/Ddis/post.json';
import editDdis from '../../../fixtures/Provider/Ddis/put.json';

export const postDdi = () => {
  cy.usePactIntercept(
    {
      method: 'POST',
      url: '**/api/brand/ddis*',
      response: newDdi.response,
      matchingRules: newDdi.matchingRules,
    },
    'createDdi'
  );

  cy.usePactIntercept(
    {
      method: 'GET',
      url: '**/api/brand/companies/1*',
      response: { ...CompaniesItem },
    },
    'getCompanies-1'
  );

  cy.get('[aria-label=Add]').click();

  cy.fillTheForm(newDdi.request);
  cy.get('header li.MuiBreadcrumbs-li:last').should('contain', 'DDIs');

  cy.usePactWait(['createDdi']).its('response.statusCode').should('eq', 201);
};

export const putDdi = () => {
  cy.usePactIntercept(
    {
      method: 'GET',
      url: '**/api/brand/ddis/1',
      response: { ...DdiItem },
    },
    'getDdis-1'
  );

  cy.usePactIntercept(
    {
      method: 'PUT',
      url: `**/api/brand/ddis/${editDdis.response.body.id}`,
      response: editDdis.response,
    },
    'editDdis'
  );

  cy.get('svg[data-testid="EditIcon"]').eq(1).click();

  const { country, ddiProvider, ddi } = editDdis.request;
  cy.fillTheForm({ country, ddiProvider, ddi });

  cy.get('header').should('contain', 'DDIs');

  cy.usePactWait(['editDdis']).its('response.statusCode').should('eq', 200);
};

export const deleteDdi = () => {
  cy.intercept('DELETE', '**/api/brand/ddis/*', {
    statusCode: 204,
  }).as('deleteDdi');

  cy.contains('DDIs').click();

  cy.get('td button svg[data-testid="MoreHorizIcon"]').first().click();
  cy.get('li.MuiMenuItem-root').contains('Delete').click();

  cy.contains('Remove element');
  cy.get('[role="dialog"]')
    .filter(':visible')
    .contains('Yes, delete it')
    .click();

  cy.get('header li.MuiBreadcrumbs-li:last').should('contain', 'DDIs');

  cy.usePactWait(['deleteDdi']).its('response.statusCode').should('eq', 204);
};

export const importDdis = () => {
  cy.intercept('GET', '**/api/brand/companies/1*', { ...CompaniesItem }).as(
    'getCompany-1'
  );

  cy.intercept(
    { method: 'POST', url: '**/api/brand/ddis/mass_import', middleware: true },
    (req) => {
      req.on('response', (res) => {
        res.setDelay(1500);
      });
    }
  );

  cy.intercept('POST', '**/api/brand/ddis/mass_import', {
    statusCode: ddisMassImport.response.statusCode,
    body: ddisMassImport.response.body,
  }).as('ddisMassImport');

  cy.get('button svg[data-testid="MoreHorizIcon"]').first().click();
  cy.get('li.MuiMenuItem-root').contains('Import DDIs').click();
  cy.get('h2').should('contain', 'Import DDIs');
  cy.contains('Download template');
  cy.contains('button', 'Send').should('be.disabled');

  cy.get('input[type="file"]').selectFile(
    {
      contents: Cypress.Buffer.from('944048182\n944048183\n123\n124\n+34abc\n'),
      fileName: 'ddis.csv',
      mimeType: 'text/csv',
    },
    { force: true }
  );
  cy.contains('button', 'Send').should('be.disabled');

  cy.get('input[name="company"]').click().clear().type('{downArrow}');
  cy.get('li[data-value=1]').click();
  cy.wait('@getCompany-1');
  cy.contains('button', 'Send').should('be.enabled');

  cy.get('input[name="country"]').click().clear().type('{downArrow}');
  cy.get('li[data-value=3]').click();

  cy.get('input[name="ddiProvider"]').click().clear().type('{downArrow}');
  cy.get('li[data-value=1]').click();

  cy.contains('button', 'Send').click();
  cy.contains('Importing, please wait');

  cy.wait('@ddisMassImport').then(({ request, response }) => {
    expect(response.statusCode).to.eq(201);
    expect(request.body).to.include('name="company"\r\n\r\n1\r\n');
    expect(request.body).to.include('name="country"\r\n\r\n3\r\n');
    expect(request.body).to.include('name="ddiProvider"\r\n\r\n1\r\n');
    expect(request.body).to.include('name="csv"');
  });

  cy.contains('Created: 2');
  cy.contains('Updated: 1');
  cy.contains('Skipped: 1');
  cy.contains('Failed: 1');
  cy.contains('Updated lines: 3');
  cy.contains('Line 4: DDI already assigned to another client');
  cy.contains('Line 5: Value "+34abc" does not match expression.');
};

export const assertNoDdisImportAction = () => {
  cy.contains('Import DDIs').should('not.exist');
  cy.get('svg[data-testid="UploadFileIcon"]').should('not.exist');
};
