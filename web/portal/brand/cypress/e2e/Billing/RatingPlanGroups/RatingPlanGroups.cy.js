import RecordingPlanGroupCollection from '../../../fixtures/Provider/RatingPlanGroups/getCollections.json';
import ratingPlaGroupItem from '../../../fixtures/Provider/RatingPlanGroups/getItem.json';
import newRatingPlaGroup from '../../../fixtures/Provider/RatingPlanGroups/postItem.json';
import simulateCall from '../../../fixtures/Provider/RatingPlanGroups/postSimulateCall.json';
import editRatingPlaGroup from '../../../fixtures/Provider/RatingPlanGroups/putItem.json';

describe('in Rating Plan Group', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('ratingPlanGroups');
    cy.before();

    cy.get('svg[data-testid="WalletIcon"]').first().click();
    cy.contains('Rating Plan Groups').click();

    cy.get('header').should('contain', 'Rating Plan Groups');

    cy.get('table').should(
      'contain',
      RecordingPlanGroupCollection.body[0].name['en']
    );
  });

  it('add Rating Plan Group', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/brand/rating_plan_groups*',
        response: newRatingPlaGroup.response,
        matchingRules: newRatingPlaGroup.matchingRules,
      },
      'createRatingPlanGroup'
    );

    cy.get('[aria-label=Add]').click();

    cy.get('header').should('contain', 'New');

    cy.fillTheForm(newRatingPlaGroup.request);

    cy.get('header').should('contain', 'Rating Plan Groups');

    cy.usePactWait('createRatingPlanGroup')
      .its('response.statusCode')
      .should('eq', 201);
  });

  it('edit Rating Plan Group', () => {
    cy.usePactIntercept(
      {
        method: 'GET',
        url: '**/api/brand/rating_plan_groups/1',
        response: { ...ratingPlaGroupItem },
      },
      'getRatingPlanGroup-1'
    );

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/brand/rating_plan_groups/${editRatingPlaGroup.response.body.id}`,
        response: editRatingPlaGroup.response,
      },
      'editRatingPlanGroup'
    );

    cy.get('svg[data-testid="EditIcon"]').first().click();

    cy.fillTheForm(editRatingPlaGroup.request);
    cy.get('header').should('contain', 'Rating Plan Groups');

    cy.usePactWait(['editRatingPlanGroup'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  it('delete Rating Plan Group', () => {
    cy.intercept('DELETE', '**/api/brand/rating_plan_groups/1', {
      statusCode: 204,
    }).as('deleteRatingPlanGroup');

    cy.get('td button > svg[data-testid="DeleteIcon"]').first().click();

    cy.contains('Remove element');
    cy.get('div.MuiDialog-container button')
      .filter(':visible')
      .contains('Yes, delete it')
      .click();

    cy.get('header').should('contain', 'Rating Plan Groups');

    cy.usePactWait(['deleteRatingPlanGroup'])
      .its('response.statusCode')
      .should('eq', 204);
  });

  it('simulate call', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/brand/rating_plan_groups/1/simulate_call',
        response: simulateCall.response,
      },
      'postSimulatePactWait'
    );

    cy.intercept('**/api/brand/rating_plan_groups/2/simulate_call', {});
    cy.get('.list-content-header [data-testid="MoreHorizIcon"]')
      .first()
      .click();

    cy.contains('Simulate call').first().click();

    cy.contains('Phone number')
      .siblings('.input-field')
      .clear()
      .type(simulateCall.request.number);

    cy.contains('Duration (seconds)')
      .siblings('.input-field')
      .clear()
      .type(simulateCall.request.duration);

    cy.contains('Accept').click();

    cy.usePactWait(['postSimulatePactWait'])
      .its('response.statusCode')
      .should('eq', 200);

    cy.get('table')
      .eq(1)
      .should('contain', simulateCall.response.body.callDate);
  });

  it('does something wiht money icon', () => {
    cy.usePactIntercept(
      {
        method: 'GET',
        url: '**/rating_plans?*',
        response: {},
      },
      'ratingPlans'
    );
    cy.get('table [data-testid="MoneyIcon"]').first().click();

    cy.get('header').should('contain', 'Destination rates');
  });
});
