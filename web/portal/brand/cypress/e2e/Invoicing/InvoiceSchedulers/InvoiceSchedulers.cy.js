import InvoiceSchedulers from '../../../fixtures/Provider/InvoiceNumberSequence/getCollection.json';
import {
  deleteteInvoiceSchedulers,
  postInvoiceSchedulers,
  putInvoiceSchedulers,
} from './InvoiceSchedulers.tests';

describe('in Invoice Schedulers', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Invoice-invoice-schedulers');
    cy.before();

    cy.get(`svg[data-testid="DescriptionIcon"]`).click();
    cy.contains('Invoice Schedulers').click();

    cy.get('header').should('contain', 'Invoice Schedulers');

    cy.get('table').should('contain', InvoiceSchedulers.body[0].id);
  });

  /////////////////////////////
  //POST
  /////////////////////////////
  it('post Invoice schedulers', postInvoiceSchedulers);

  /////////////////////////////
  //PUT
  /////////////////////////////
  it('edit Invoice schedulers', putInvoiceSchedulers);

  // ///////////////////////
  // // DELETE
  // ///////////////////////
  it('delete Invoice schedulers', deleteteInvoiceSchedulers);
});
