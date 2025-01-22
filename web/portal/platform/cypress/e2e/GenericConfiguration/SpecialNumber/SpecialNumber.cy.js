import SpecialNumberCollection from '../../../fixtures/SpecialNumber/getCollection.json';
import {
  deleteteSpecialNumbers,
  postSpecialNumbers,
  putSpecialNumbers,
} from './SpecialNumber.tests';

describe('in Special Numbers', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Special-numbers');
    cy.before();

    cy.contains('Generic Configuration').click();
    cy.contains('Global Special Numbers').click();

    cy.get('header').should('contain', 'Global Special Numbers');

    cy.get('table').should('contain', SpecialNumberCollection.body[0].id);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add Special Numbers', postSpecialNumbers);

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit Special Numbers', putSpecialNumbers);

  ///////////////////////////////
  // DELETE
  ///////////////////////////////
  it('delete Special Number', deleteteSpecialNumbers);
});
