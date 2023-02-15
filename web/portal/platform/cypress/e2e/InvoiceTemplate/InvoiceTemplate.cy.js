import InvoiceTemplateCollection from '../../fixtures/InvoiceTemplate/getCollection.json';
import newInvoiceTemplate from '../../fixtures/InvoiceTemplate/post.json';
import InvoiceTemplateItem from '../../fixtures/InvoiceTemplate/getItem.json';
import editInvoiceTemplate from '../../fixtures/InvoiceTemplate/put.json';

describe('in Invoice Template', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('InvoiceTemplate');
    cy.before();

    cy.contains('Invoice Template').click();

    cy.get('h3').should('contain', 'List of Invoice Template');

    cy.get('table').should('contain', InvoiceTemplateCollection.body[0].name);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add Invoice Template', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/platform/invoice_templates*',
        response: newInvoiceTemplate.response,
        matchingRules: newInvoiceTemplate.matchingRules,
      },
      'createInvoiceTemplate'
    );

    cy.get('[aria-label=Add]').click();

    cy.fillTheForm(newInvoiceTemplate.request);

    cy.get('h3').should('contain', 'List of Invoice Template');

    cy.usePactWait('createInvoiceTemplate')
      .its('response.statusCode')
      .should('eq', 201);
  });

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit Invoice Template', () => {
    cy.intercept('GET', '**/api/platform/invoice_templates/1', {
      ...InvoiceTemplateItem,
    }).as('getInvoiceTemplate-1');

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/platform/invoice_templates/${editInvoiceTemplate.response.body.id}`,
        response: editInvoiceTemplate.response,
      },
      'editInvoiceTemplate'
    );

    cy.get('svg[data-testid="EditIcon"]').first().click();

    cy.fillTheForm(editInvoiceTemplate.request);

    cy.contains('List of Invoice Template');

    cy.usePactWait(['editInvoiceTemplate'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete Invoice Template', () => {
    cy.intercept('DELETE', '**/api/platform/invoice_templates/*', {
      statusCode: 204,
    }).as('deleteInvoiceTemplate');

    cy.get('td > a > svg[data-testid="DeleteIcon"]').first().click();

    cy.contains('Remove element');
    cy.get('div[role=dialog] button')
      .filter(':visible')
      .contains('Delete')
      .click();

    cy.get('h3').should('contain', 'List of Invoice Template');

    cy.usePactWait(['deleteInvoiceTemplate'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
