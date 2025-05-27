import InvoiceTemplateCollection from '../../../fixtures/InvoiceTemplate/getCollection.json';
import {
  deleteteInvoiceTemplate,
  postInvoiceTemplate,
  putInvoiceTemplate,
} from './InvoiceTemplate.tests';

describe('in Invoice Template', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('InvoiceTemplate');
    cy.before();

    cy.contains('Generic Configuration').click();
    cy.contains('Default Invoice templates').click();

    cy.get('header').should('contain', 'Default Invoice templates');

    cy.get('table').should('contain', InvoiceTemplateCollection.body[0].name);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add Invoice Template', postInvoiceTemplate);

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit Invoice Template', putInvoiceTemplate);

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete Invoice Template', deleteteInvoiceTemplate);
});
