import BrandCollection from '../../../fixtures/Provider/Brand/getCollection.json';
import BrandOperatorCollection from '../../../fixtures/Provider/BrandOperator/getCollection.json';
import {
  deleteBrandOperator,
  postBrandOperator,
  putBrandOperator,
} from './BrandOperators';

describe('in Brand Operators', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('BrandOperators', {
      queryFilters: { brand: true },
    });

    cy.intercept('GET', '**/api/platform/brands/1*', {
      ...BrandCollection,
      body: BrandCollection.body.find((row) => row.id === 1),
    }).as('getBrand-1');

    cy.before('Brands');
    cy.get('td button svg[data-testid="MoreHorizIcon"]').eq(0).click();
    cy.get('li.MuiMenuItem-root')
      .contains(/^Brand operators$/)
      .click();
    cy.get('header li.MuiBreadcrumbs-li:last').should(
      'contain',
      'Brand operators'
    );

    cy.get('table').should('contain', BrandOperatorCollection.body[0].name);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add Brand Operator', postBrandOperator);

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit Brand Operator', putBrandOperator);

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete Brand Operator', deleteBrandOperator);
});
