import DdiProvidersRegistrationsItem from '../../../../fixtures/Provider/DdiProviders/getProviderRegistrationsItem.json';
import newDdiProvidersRegistrations from '../../../../fixtures/Provider/DdiProviders/postProviderRegistrations.json';
import editDdisProvidersRegistrations from '../../../../fixtures/Provider/DdiProviders/putProviderRegistrations.json';

export const postDdiProvidersRegistrations = () => {
  cy.usePactIntercept(
    {
      method: 'POST',
      url: '**/api/brand/ddi_provider_registrations*',
      response: newDdiProvidersRegistrations.response,
      matchingRules: newDdiProvidersRegistrations.matchingRules,
    },
    'createDdiProvidersRegistrations'
  );

  cy.get('[aria-label=Add]').click();
  cy.get('header').should('contain', 'DDI Provider Registrations');

  const {
    username,
    domain,
    realm,
    authUsername,
    authPassword,
    authProxy,
    expires,
    multiDdi,
  } = newDdiProvidersRegistrations.request;
  cy.fillTheForm({
    username,
    domain,
    realm,
    authUsername,
    authPassword,
    authProxy,
    expires,
    multiDdi,
  });

  cy.usePactWait(['createDdiProvidersRegistrations'])
    .its('response.statusCode')
    .should('eq', 201);
};

export const putDdiProvidersRegistrations = () => {
  cy.usePactIntercept(
    {
      method: 'GET',
      url: '**/api/brand/ddi_provider_registrations/1',
      response: { ...DdiProvidersRegistrationsItem },
    },
    'getDdisProvidersRegistrations-1'
  );

  cy.usePactIntercept(
    {
      method: 'PUT',
      url: `**/api/brand/ddi_provider_registrations/${editDdisProvidersRegistrations.response.body.id}`,
      response: editDdisProvidersRegistrations.response,
    },
    'editDdisProvidersRegistrations'
  );

  cy.get('svg[data-testid="EditIcon"]').click();
  const { ...rest } = editDdisProvidersRegistrations.request;
  delete rest.domain;
  delete rest.contactUsername;
  delete rest.ddiProvider;
  cy.fillTheForm({ ...rest });

  cy.get('header').should('contain', 'DDI Provider Registrations');

  cy.usePactWait(['editDdisProvidersRegistrations'])
    .its('response.statusCode')
    .should('eq', 200);
};

export const deleteDdiProvidersRegistrations = () => {
  cy.intercept('DELETE', '**/api/brand/ddi_provider_registrations/*', {
    statusCode: 204,
  }).as('deleteDdiProvidersRegistrations');

  cy.get('td button svg[data-testid="DeleteIcon"]').first().click();

  cy.contains('Remove element');
  cy.get('[role="dialog"]')
    .filter(':visible')
    .contains('Yes, delete it')
    .click();

  cy.get('header').should('contain', 'DDI Provider Registrations');

  cy.usePactWait(['deleteDdiProvidersRegistrations'])
    .its('response.statusCode')
    .should('eq', 204);
};
