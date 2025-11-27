import BrandServiceItem from '../../../fixtures/Provider/BrandService/getItem.json';
import newBrandService from '../../../fixtures/Provider/Service/post.json';
import editBrandService from '../../../fixtures/Provider/Service/put.json';
import BrandServiceCollection from './../../../fixtures/Provider/BrandService/getCollection.json';

describe('in Brand services', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Brand-services');
    cy.before('');

    cy.get('svg[data-testid="SettingsIcon"]').first().click();
    cy.contains('Brand services').click();

    cy.get('header').should('contain', 'Brand services');

    cy.get('table').should('contain', BrandServiceCollection.body[0].code);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add Brand services', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/brand/brand_services*',
        response: newBrandService.response,
        matchingRules: newBrandService.matchingRules,
      },
      'createBrandService'
    );

    cy.get('[aria-label=Add]').click();

    cy.fillTheForm(newBrandService.request);

    cy.get('header').should('contain', 'Brand services');

    cy.usePactWait(['createBrandService'])
      .its('response.statusCode')
      .should('eq', 201);
  });

  ///////////////////
  // PUT
  ///////////////////
  it('edit Brand services', () => {
    cy.intercept('GET', '**/api/brand/brand_services/1', {
      ...BrandServiceItem,
    }).as('getBrandService-1');

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/brand/brand_services/${editBrandService.response.body.id}`,
        response: editBrandService.response,
      },
      'editBrandService'
    );

    cy.get('svg[data-testid="EditIcon"]').eq(0).click();
    const { ...rest } = editBrandService.request;
    delete rest.service;

    cy.fillTheForm(rest);

    cy.usePactWait(['editBrandService'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  /////////////////////
  //// DELETE
  /////////////////////
  it('delete Brand services', () => {
    cy.intercept('DELETE', '**/api/brand/brand_services/1', {
      statusCode: 204,
    }).as('deleteBrandService');

    cy.get('td button > svg[data-testid="DeleteIcon"]').eq(0).click();

    cy.contains('Remove element');

    cy.get('[role="dialog"]')
      .filter(':visible')
      .contains('Yes, delete it')
      .click();

    cy.get('header').should('contain', 'Brand services');

    cy.usePactWait(['deleteBrandService'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
