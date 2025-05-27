import CurrenciesCollection from '../../../fixtures/Currencies/getCollection.json';
import {
  deleteteCurrencies,
  postCurrencies,
  putCurrencies,
} from './Currencies.tests';

describe('in Currencies', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Currencies');
    cy.before();

    cy.contains('Generic Configuration').click();
    cy.contains('Currencies').click();

    cy.get('header').should('contain', 'Currencies');

    cy.get('table').should('contain', CurrenciesCollection.body[0].iden);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add Currencies', postCurrencies);

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit Currencies', putCurrencies);

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete Invoice Template', deleteteCurrencies);
});
