import newApplicationServers from '../../../fixtures/ApplicationServer/post.json';
import editApplicationServers from '../../../fixtures/ApplicationServer/put.json';

export const postApplicationServers = () => {
  cy.usePactIntercept(
    {
      method: 'POST',
      url: '**/api/platform/application_servers*',
      response: newApplicationServers.response,
      matchingRules: newApplicationServers.matchingRules,
    },
    'createApplicationServers'
  );

  cy.get('[aria-label=Add]').click();

  cy.fillTheForm(newApplicationServers.request);

  cy.get('header').should('contain', 'Application Servers');

  cy.usePactWait('createApplicationServers')
    .its('response.statusCode')
    .should('eq', 201);
};

export const putApplicationServers = () => {
  cy.intercept('GET', '**/api/platform/application_servers/1', {
    ...editApplicationServers,
  }).as('getMediaRelaySets-1');

  cy.usePactIntercept(
    {
      method: 'PUT',
      url: `**/api/platform/application_servers/${editApplicationServers.response.body.id}`,
      response: editApplicationServers.response,
    },
    'editApplicationServers'
  );

  cy.get('svg[data-testid="EditIcon"]').first().click();

  cy.fillTheForm(editApplicationServers.request);
  cy.get('header').should('contain', 'Application Servers');

  cy.usePactWait(['editApplicationServers'])
    .its('response.statusCode')
    .should('eq', 200);
};

export const deleteApplicationServers = () => {
  cy.intercept('DELETE', '**/api/platform/application_servers/*', {
    statusCode: 204,
  }).as('deleteApplicationServers');

  cy.get('td button > svg[data-testid="DeleteIcon"]').first().click();

  cy.contains('Remove element');
  cy.get('div.MuiDialog-container button')
    .filter(':visible')
    .contains('Yes, delete it')
    .click();

  cy.get('header').should('contain', 'Application Servers');

  cy.usePactWait(['deleteApplicationServers'])
    .its('response.statusCode')
    .should('eq', 204);
};
