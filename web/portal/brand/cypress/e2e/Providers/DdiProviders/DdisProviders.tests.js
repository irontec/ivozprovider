import DdiProvidersItem from '../../../fixtures/Provider/DdiProviders/getItem.json';
import newDdiProviders from '../../../fixtures/Provider/DdiProviders/post.json';
import editDdisProviders from '../../../fixtures/Provider/DdiProviders/put.json';
import ProxyTrunksItem from '../../../fixtures/Provider/ProxyTrunks/getItem.json';

export const postDdiProviders = () => {
  cy.usePactIntercept(
    {
      method: 'POST',
      url: '**/api/brand/ddi_providers*',
      response: newDdiProviders.response,
      matchingRules: newDdiProviders.matchingRules,
    },
    'createDdiProviders'
  );
  cy.usePactIntercept(
    {
      method: 'GET',
      url: '**/api/brand/proxy_trunks/1*',
      response: { ...ProxyTrunksItem },
    },
    'getProxyTrunk-1'
  );

  cy.get('[aria-label=Add]').click();
  cy.get('header').should('contain', 'DDI Providers');

  const { description, name, transformationRuleSet, mediaRelaySet } =
    newDdiProviders.request;
  cy.fillTheForm({ description, name, transformationRuleSet, mediaRelaySet });

  cy.usePactWait(['createDdiProviders'])
    .its('response.statusCode')
    .should('eq', 201);
};

export const putDdiProviders = () => {
  cy.usePactIntercept(
    {
      method: 'GET',
      url: '**/api/brand/ddi_providers/1',
      response: { ...DdiProvidersItem },
    },
    'getDdisProviders-1'
  );

  cy.usePactIntercept(
    {
      method: 'PUT',
      url: `**/api/brand/ddi_providers/${editDdisProviders.response.body.id}`,
      response: editDdisProviders.response,
    },
    'editDdisProviders'
  );

  cy.get('svg[data-testid="EditIcon"]').click();

  const { description, name, mediaRelaySet } = editDdisProviders.request;
  cy.fillTheForm({ description, name, mediaRelaySet });

  cy.get('header').should('contain', 'DDI Providers');

  cy.usePactWait(['editDdisProviders'])
    .its('response.statusCode')
    .should('eq', 200);
};

export const deleteDdiProviders = () => {
  cy.intercept('DELETE', '**/api/brand/ddi_providers/*', {
    statusCode: 204,
  }).as('deleteDdiProviders');

  cy.get('td button svg[data-testid="MoreHorizIcon"]').first().click();
  cy.get('li.MuiMenuItem-root').contains('Delete').click();

  cy.contains('Remove element');
  cy.get('div.MuiDialog-container button')
    .filter(':visible')
    .contains('Yes, delete it')
    .click();

  cy.get('header').should('contain', 'DDI Providers');

  cy.usePactWait(['deleteDdiProviders'])
    .its('response.statusCode')
    .should('eq', 204);
};
