import BrandsCollection from '../../fixtures/Provider/Brand/getCollection.json';
import { deleteBrand, postBrand, putBrand } from './Brand.tests';

describe('in Brands', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Brands');
    cy.before();

    cy.get('svg[data-testid="OfflinePinIcon"]').first().click();

    cy.get('header').should('contain', 'Brands');

    cy.get('table').should('contain', BrandsCollection.body[0].name);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add Brand', postBrand);

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit Brand', putBrand);

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete Brand', deleteBrand);
});
