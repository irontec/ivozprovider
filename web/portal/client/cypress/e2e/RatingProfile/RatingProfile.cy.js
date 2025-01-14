import RatingProfileCollection from '../../fixtures/RatingProfiles/getCollection.json';

describe('RatingProfiles', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('RatingProfiles');
    cy.before();

    cy.contains('Billing').click();
    cy.contains('Rating profiles').click();

    cy.get('header').should('contain', 'Rating profiles');

    cy.get('table').should(
      'contain',
      RatingProfileCollection.body[0].ratingPlanGroup
    );
  });

  it('has disabled buttons', () => {
    cy.get('[data-testid="EditIcon"]').first().should('not.be.enabled');
    cy.get('[data-testid="DeleteIcon"]').first().should('not.be.enabled');
  });
});
