import BrandCollection from '../../../fixtures/Provider/Brand/getCollection.json';
import WebPortalsCollection from '../../../fixtures/Provider/WebPortal/getCollection.json';
import {
  deleteBrandPortal,
  postBrandPortal,
  putBrandPortal,
} from './BrandPortal.tests';

describe('in Brand Portals', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('BrandPortals');

    cy.intercept('GET', '**/api/platform/brands/1*', {
      ...BrandCollection,
      body: BrandCollection.body.find((row) => row.id === 1),
    }).as('getBrand1');

    cy.before('Brands');
    cy.get('td button svg[data-testid="MoreHorizIcon"]').eq(1).click();
    cy.get('li.MuiMenuItem-root')
      .contains(/^Brand Portals$/)
      .click();
    cy.get('header li.MuiBreadcrumbs-li:last').should(
      'contain',
      'Brand Portals'
    );

    cy.get('table').should('contain', WebPortalsCollection.body[0].name);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add Brand Portal', postBrandPortal);

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit Brand Portal', putBrandPortal);

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete Brand Portal', deleteBrandPortal);
});
