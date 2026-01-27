import RatingProfiles from '../../../fixtures/Provider/RatingProfile/getCollection.json';
import postItem from '../../../fixtures/Provider/RatingProfile/postItem.json';
import updateItem from '../../../fixtures/Provider/RatingProfile/putItem.json';

export const postProfile = () => {
  cy.usePactIntercept(
    {
      method: 'POST',
      url: '**/api/brand/rating_profiles*',
      response: postItem.response,
    },
    'postRatingProfile'
  );

  cy.contains('Add').click();
  cy.get('header').should('contain', 'New');

  const { activationTime, ratingPlanGroup } = postItem.request;
  const fixedActivationTime = activationTime.replace(' ', 'T');

  cy.fillTheForm({
    activationTime: fixedActivationTime,
    ratingPlanGroup: ratingPlanGroup,
  });

  cy.usePactWait('postRatingProfile')
    .its('response.statusCode')
    .should('eq', 201);
};

export const putProfile = () => {
  const ratingProfile = RatingProfiles.body[0];
  cy.intercept('GET', '**/api/brand/rating_profiles/1', {
    ...ratingProfile,
  }).as('getRatingProfile-1');

  cy.intercept('PUT', '**/api/brand/rating_profiles/1', {
    ...updateItem.response,
  }).as('putRatingProfile-1');

  cy.get('table [data-testid="EditIcon"]').first().click();

  const { activationTime, ratingPlanGroup } = updateItem.request;
  const fixedActivationTime = activationTime.replace(' ', 'T');

  cy.fillTheForm({
    activationTime: fixedActivationTime,
    ratingPlanGroup: ratingPlanGroup,
  });

  cy.usePactWait('putRatingProfile-1')
    .its('response.statusCode')
    .should('eq', 200);
};

export const deleteProfile = () => {
  cy.intercept('DELETE', '**/api/brand/rating_profiles/1', {
    statusCode: 204,
  }).as('deleteRatingProfile-1');

  cy.get('table [data-testid="DeleteIcon"]').first().click();

  cy.get('[role="dialog"]')
    .filter(':visible')
    .contains('Yes, delete it')
    .click();

  cy.usePactWait(['deleteRatingProfile-1'])
    .its('response.statusCode')
    .should('eq', 204);

  cy.get('header').should('contain', 'Rating Profiles');
};
