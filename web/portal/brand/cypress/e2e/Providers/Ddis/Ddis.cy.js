import DdisCollection from '../../../fixtures/Provider/Ddis/getCollection.json';
import { deleteDdi, postDdi, putDdi } from './Ddis.tests';

describe('in Ddis', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('DDIs');
    cy.before();

    cy.get('svg[data-testid="PrecisionManufacturingIcon"]').first().click();
    cy.contains('DDIs').click();

    cy.get('header').should('contain', 'DDIs');

    cy.get('table').should('contain', DdisCollection.body[0].id);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add Ddi', postDdi);

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit Ddi', putDdi);

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete Ddi', deleteDdi);
});
