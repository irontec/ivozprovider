import DdiCollection from '../../../fixtures/Ddi/getCollection.json';
import DdiItem from '../../../fixtures/Ddi/getItem.json';
import WebhookCollection from '../../../fixtures/Webhook/getCollection.json';
import WebhookItem from '../../../fixtures/Webhook/getItem.json';
import newWebhook from '../../../fixtures/Webhook/post.json';
import editWebhook from '../../../fixtures/Webhook/put.json';

describe('Ddi Webhook', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Ddi-Webhook');
    cy.before();

    cy.intercept('GET', '**/api/client/ddis/1', {
      ...DdiItem,
    }).as('getDdi-1');

    cy.contains('DDIs').click();
    cy.get('header').should('contain', 'DDIs');
    cy.get('table').should('contain', DdiCollection.body[0].ddie164);

    cy.get('td button svg[data-testid="MoreHorizIcon"]').first().click();
    cy.get('li.MuiMenuItem-root')
      .contains(/^Webhooks$/)
      .click();
    cy.get('header').should('contain', 'Webhooks');

    cy.get('table').should('contain', WebhookCollection.body[0].name);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add Webhook', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/client/webhooks*',
        response: newWebhook.response,
        matchingRules: newWebhook.matchingRules,
      },
      'createWebhook'
    );

    cy.get('[aria-label=Add]').click();

    cy.fillTheForm(newWebhook.request);

    cy.get('header').should('contain', 'Webhooks');

    cy.usePactWait(['createWebhook'])
      .its('response.statusCode')
      .should('eq', 201);
  });

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit Webhook', () => {
    cy.usePactIntercept(
      {
        method: 'GET',
        url: '**/api/client/webhooks/2',
        response: { ...WebhookItem },
      },
      'getWebhook-2'
    );

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/client/webhooks/${editWebhook.response.body.id}`,
        response: editWebhook.response,
      },
      'editWebhook'
    );

    cy.get('svg[data-testid="EditIcon"]').first().click();

    cy.fillTheForm(editWebhook.request);

    cy.get('header').should('contain', 'Webhooks');

    cy.usePactWait(['editWebhook'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete Webhook', () => {
    cy.intercept('DELETE', '**/api/client/webhooks/2', {
      statusCode: 204,
    }).as('deleteWebhook');

    cy.get('td button svg[data-testid="DeleteIcon"]').first().click();
    cy.get('[role="dialog"]')
      .filter(':visible')
      .contains('Yes, delete it')
      .click();

    cy.get('header').should('contain', 'Webhooks');

    cy.usePactWait(['deleteWebhook'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
