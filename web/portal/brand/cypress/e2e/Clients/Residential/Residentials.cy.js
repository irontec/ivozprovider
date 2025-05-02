import CompaniesCollection from '../../../fixtures/Provider/Companies/getCollection.json';
import {
  deleteCompany,
  postCompany,
  postWebPortal,
  putCompany,
} from './Residentials.tests';

describe('in Residential Companies', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('residential');
    cy.before();

    cy.get('svg[data-testid="BusinessIcon"]').first().click();
    cy.contains('Residentials').click();

    cy.get('header').should('contain', 'Residentials');

    cy.get('table').should(
      'contain',
      CompaniesCollection.body.find((element) => element.type === 'residential')
        .id
    );
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add Residential Companies', postCompany);

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit Residential Companies', putCompany);

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete Residential Companies', deleteCompany);

  ///////////////////////
  // POST
  ///////////////////////
  it('post Web Portal', postWebPortal);
});
