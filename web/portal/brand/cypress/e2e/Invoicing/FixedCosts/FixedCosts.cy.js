import FixedCostsCollection from '../../../fixtures/FixedCosts/getCollection.json';
import {
  deleteteFixedCosts,
  postFixedCosts,
  putFixedCosts,
} from './FixedCosts.tests';

describe('in Fixed costs', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Fixed-costs');
    cy.before();

    cy.get(`svg[data-testid="DescriptionIcon"]`).click();
    cy.contains('Fixed costs').click();

    cy.get('header').should('contain', 'Fixed costs');

    cy.get('table').should('contain', FixedCostsCollection.body[0].id);
  });

  /////////////////////////////
  //POST
  /////////////////////////////
  it('post Fixed Costs', postFixedCosts);
  /////////////////////////////
  //PUT
  /////////////////////////////
  it('edit Fixed Costs', putFixedCosts);

  // ///////////////////////
  // // DELETE
  // ///////////////////////
  it('delete Fixed Costs', deleteteFixedCosts);
});
