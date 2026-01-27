import newBrandOperator from '../../../fixtures/Provider/BrandOperator/post.json';
import editBrandOperator from '../../../fixtures/Provider/BrandOperator/put.json';

export const postBrandOperator = () => {
  cy.usePactIntercept(
    {
      method: 'POST',
      url: '**/api/platform/administrators*',
      response: newBrandOperator.response,
      matchingRules: newBrandOperator.matchingRules,
    },
    'createBrandOperator'
  );

  cy.get('[aria-label=Add]').click();

  cy.get('header').should('contain', 'Brand operators');

  const { ...rest } = newBrandOperator.request;

  delete rest.active;
  delete rest.canImpersonate;

  cy.fillTheForm({ ...rest });

  cy.usePactWait(['createBrandOperator'])
    .its('response.statusCode')
    .should('eq', 201);
};

export const putBrandOperator = () => {
  cy.usePactIntercept(
    {
      method: 'PUT',
      url: '**/api/platform/administrators/4*',
      response: editBrandOperator.response,
      matchingRules: editBrandOperator.matchingRules,
    },
    'editBrandOperator'
  );

  cy.usePactIntercept(
    {
      method: 'GET',
      url: `**/api/platform/administrators/4`,
      response: editBrandOperator.response,
    },
    'getBranOperator-4'
  );

  cy.get('svg[data-testid="EditIcon"]').first().click();

  cy.get('header').should('contain', 'Brand operators');

  const { ...rest } = editBrandOperator.request;
  delete rest.brand;
  cy.fillTheForm({ ...rest });

  cy.usePactWait(['editBrandOperator'])
    .its('response.statusCode')
    .should('eq', 200);
};

export const deleteBrandOperator = () => {
  cy.intercept('DELETE', '**/api/platform/administrators/*', {
    statusCode: 204,
  }).as('deleteClients');

  cy.get('td button svg[data-testid="MoreHorizIcon"]').first().click();
  cy.get('li.MuiMenuItem-root').contains('Delete').click();

  cy.contains('Remove element');
  cy.get('[role="dialog"]')
    .filter(':visible')
    .contains('Yes, delete it')
    .click();
};
