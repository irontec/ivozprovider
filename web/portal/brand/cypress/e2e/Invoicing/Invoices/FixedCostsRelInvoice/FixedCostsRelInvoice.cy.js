import InvoiceFidexCostsCollection from '../../../../fixtures/Provider/FixedCostsRelInvoice/getCollection.json';
import {
  deleteteFixedCostsRelInvoice,
  postFixedCostsRelInvoice,
  putFixedCostsRelInvoice,
} from './FixedCostsRelInvoice.tests';

describe('in Fixed costs rel invoice', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Invoice-fixed-costs');
    cy.before('');

    cy.get(`svg[data-testid="DescriptionIcon"]`).click();
    cy.contains('Invoices').click();
    cy.get('td button > svg[data-testid="AddCardIcon"]').first().click();

    cy.get('header').should('contain', 'Fixed costs');

    cy.get('table').should('contain', InvoiceFidexCostsCollection.body[0].id);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add Fixed costs rel invoice', postFixedCostsRelInvoice);

  /////////////////////////////
  //PUT
  /////////////////////////////
  it('edit Fixed costs rel invoice', putFixedCostsRelInvoice);

  // ///////////////////////
  // // DELETE
  // ///////////////////////
  it('delete Fixed costs rel invoice', deleteteFixedCostsRelInvoice);
});
