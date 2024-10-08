import CompaniesCollection from '../../../fixtures/Provider/Companies/getCollection.json';
import PBXsItem from '../../../fixtures/Provider/Companies/VirtualPbxs/getItem.json';
import {
  deleteCompany,
  postCompany,
  postWebPortal,
  putCompany,
} from './VirtualPbxs.tests';

describe('in Companies', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('vpbx');
    cy.before();

    cy.get('svg[data-testid="MapsHomeWorkIcon"]').first().click();
    cy.contains('Virtual PBXs').click();

    cy.get('header').should('contain', 'Virtual PBXs');

    cy.get('table').should('contain', CompaniesCollection.body[0].id);
  });

  it('Impersonate enabled', () => {
    cy.intercept('GET', '**/api/brand/vPbx/1', {
      ...PBXsItem,
    }).as('getCompanies-1');

    cy.get('svg[data-testid="AdminPanelSettingsIcon"]')
      .eq(1)
      .first()
      .scrollIntoView();

    cy.get('svg[data-testid="AdminPanelSettingsIcon"]')
      .first()
      .parent('button')
      .should('be.visible')
      .should('not.be.disabled');
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add Virtual Pbx Companies', postCompany);

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit Virtual Pbx Companies', putCompany);

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete Virtual Pbx Companies', deleteCompany);

  ///////////////////////
  // POST
  ///////////////////////
  it('post Web Portal', postWebPortal);
});
