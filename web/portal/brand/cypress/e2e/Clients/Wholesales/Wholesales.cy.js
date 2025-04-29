import CompaniesCollection from '../../../fixtures/Provider/Companies/getCollection.json';
import { postWebPortal } from '../Residential/Residentials.tests';
import { deleteCompany, postCompany, putCompany } from './Wholesales.tests';

describe('in Wholesales Companies', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('wholesale');
    cy.before();

    cy.get('svg[data-testid="BusinessIcon"]').first().click();
    cy.contains('Wholesales').click();

    cy.get('header').should('contain', 'Wholesales');

    cy.get('table').should(
      'contain',
      CompaniesCollection.body.find((element) => element.type === 'retail').id
    );
  });

  it('add Wholesale Companies', postCompany);

  it('edit Wholesale Companies', putCompany);

  it('delete Wholesale Companies', deleteCompany);

  it('post Web Portal', postWebPortal);
});
