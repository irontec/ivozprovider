import AdministratorRelPublicEntitiesItem from '../../../fixtures/AdministratorRelPublicEntities/getItem.json';
import editAdministratorRelPublicEntities from '../../../fixtures/AdministratorRelPublicEntities/put.json';

export const putAdministratorRelPublicEntities = () => {
  cy.intercept('GET', '**/api/platform/administrator_rel_public_entities/245', {
    ...AdministratorRelPublicEntitiesItem,
  }).as('getAdministratorRelPublicEntities-245');

  cy.usePactIntercept(
    {
      method: 'PUT',
      url: `**/api/platform/administrator_rel_public_entities/${editAdministratorRelPublicEntities.response.body.id}`,
      response: editAdministratorRelPublicEntities.response,
    },
    'editAdministratorRelPublicEntities'
  );

  cy.get('svg[data-testid="EditIcon"]').first().click();

  const { ...rest } = editAdministratorRelPublicEntities.request;
  delete rest.administrator;
  delete rest.publicEntity;

  cy.fillTheForm({ ...rest });

  cy.get('header').should('contain', 'Administrator access privileges');

  cy.usePactWait(['editAdministratorRelPublicEntities'])
    .its('response.statusCode')
    .should('eq', 200);
};
