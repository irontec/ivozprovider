import CompaniesItem from '../../../../fixtures/Provider/Companies/VirtualPbxs/getItem.json';
import WebhookCollection from '../../../../fixtures/Provider/Webhook/getCollection.json';
import WebhookItem from '../../../../fixtures/Provider/Webhook/getItem.json';
import newWebhook from '../../../../fixtures/Provider/Webhook/post.json';
import editWebhook from '../../../../fixtures/Provider/Webhook/put.json';

describe('in Webhook', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('vpbx-client-webhook');
    cy.before('vpbx');

    cy.usePactIntercept(
      {
        method: 'GET',
        url: '**/api/brand/companies/1',
        response: CompaniesItem,
      },
      'getCompanies-1'
    );

    cy.contains('Clients').click();
    cy.contains('Virtual PBXs').click();
    cy.get('header').should('contain', 'Virtual PBXs');
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
        url: '**/api/brand/webhooks*',
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
        url: '**/api/brand/webhooks/4',
        response: { ...WebhookItem },
      },
      'getWebhook-4'
    );

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/brand/webhooks/${editWebhook.response.body.id}`,
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
    cy.intercept('DELETE', '**/api/brand/webhooks/4', {
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
