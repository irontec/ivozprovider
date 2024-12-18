import FixedCostsCollection from '../../../fixtures/InvoiceTemplate/getCollection.json';
import {
  deleteteInvoiceTemplates,
  postInvoiceTemplates,
  putInvoiceTemplates,
} from './InvoiceTemplate.tests';

describe('in Invoice Templates', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Invoice-templates');
    cy.before();

    cy.get(`svg[data-testid="DescriptionIcon"]`).click();
    cy.contains('Invoice templates').click();

    cy.get('header').should('contain', 'Invoice templates');

    cy.get('table').should('contain', FixedCostsCollection.body[0].name);
  });

  /////////////////////////////
  //POST
  /////////////////////////////
  it('post Invoice templates', postInvoiceTemplates);
  /////////////////////////////
  //PUT
  /////////////////////////////
  it('edit Invoice templates', putInvoiceTemplates);

  // ///////////////////////
  // // DELETE
  // ///////////////////////
  it('delete Invoice templates', deleteteInvoiceTemplates);
});
