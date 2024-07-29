import CompaniesCollection from '../../../fixtures/Provider/Companies/getCollection.json';
import {deleteCompany, postCompany, postWebPortal, putCompany} from './VirtualPbxs.tests';

describe('in Companies', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('VirtualPbxs');
    cy.before();

    cy.get('svg[data-testid="MapsHomeWorkIcon"]').first().click();
    cy.contains('Virtual PBXs').click();

    cy.get('header').should('contain', 'Virtual PBXs');

    cy.get('table').should('contain', CompaniesCollection.body[0].id);
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
