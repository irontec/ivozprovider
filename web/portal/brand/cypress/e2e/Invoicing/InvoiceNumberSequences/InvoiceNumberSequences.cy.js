import InvoiceNumberSequencesCollection from '../../../fixtures/Provider/InvoiceNumberSequence/getCollection.json';
import {
  deleteteInvoiceNumberSequences,
  postInvoiceNumberSequences,
  putInvoiceNumberSequences,
} from './InvoiceNumberSequences.tests';

describe('in Invoice number sequences ', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Invoice-number-sequences');
    cy.before();

    cy.get(`svg[data-testid="DescriptionIcon"]`).click();
    cy.contains('Invoice number sequences').click();

    cy.get('header').should('contain', 'Invoice number sequences');

    cy.get('table').should(
      'contain',
      InvoiceNumberSequencesCollection.body[0].name
    );
  });

  /////////////////////////////
  //POST
  /////////////////////////////
  it('post Invoice number sequences', postInvoiceNumberSequences);
  /////////////////////////////
  //PUT
  /////////////////////////////
  it('edit Invoice number sequences', putInvoiceNumberSequences);

  // ///////////////////////
  // // DELETE
  // ///////////////////////
  it('delete Invoice number sequences', deleteteInvoiceNumberSequences);
});
