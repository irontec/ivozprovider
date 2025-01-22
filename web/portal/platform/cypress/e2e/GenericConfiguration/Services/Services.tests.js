import ServicesItem from '../../../fixtures/Services/getItem.json';
import editService from '../../../fixtures/Services/put.json';

export const putServices = () => {
  cy.intercept('GET', '**/api/platform/services/1', {
    ...ServicesItem,
  }).as('getService-1');

  cy.usePactIntercept(
    {
      method: 'PUT',
      url: `**/api/platform/services/${editService.response.body.id}`,
      response: editService.response,
    },
    'editService'
  );

  cy.get('svg[data-testid="EditIcon"]').first().click();

  const { ...rest } = editService.request;
  delete rest.extraArgs;

  cy.fillTheForm({ ...rest });

  cy.get('header').should('contain', 'Services');

  cy.usePactWait(['editService']).its('response.statusCode').should('eq', 200);
};
