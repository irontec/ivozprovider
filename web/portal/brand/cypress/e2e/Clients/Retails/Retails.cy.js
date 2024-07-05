import CompaniesCollection from '../../../fixtures/Provider/Companies/getCollection.json';
import { deleteCompany, postCompany, putCompany } from './Retails.tests';

describe('in Residential Companies', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('VirtualPbxs');
    cy.before();

    cy.get('svg[data-testid="MapsHomeWorkIcon"]').first().click();
    cy.contains('Retails').click();

    cy.get('header').should('contain', 'Retails');

    cy.get('table').should(
      'contain',
      CompaniesCollection.body.find((element) => element.type === 'retail').id
    );
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add Retail Companies', postCompany);

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit Retail Companies', putCompany);

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete Retail Companies', deleteCompany);
});
