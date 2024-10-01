import ApplicationServerSetCollection from '../../fixtures/ApplicationServerSets/getCollection.json';
import ApplicationServerSetItem from '../../fixtures/ApplicationServerSets/getItem.json';
import PostRequest from '../../fixtures/ApplicationServerSets/post.json';

describe('in ApplicationServerSet', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('ApplicationServerSet');
    cy.before();

    cy.contains('Infrastructure').click();

    cy.contains('Application Server Sets').click();

    cy.get('header').should('contain', 'Application Server Sets');
    cy.get('tbody').should(
      'contain',
      ApplicationServerSetCollection.body[0].name
    );
  });

  it('add ApplicationServerSet', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/platform/application_server_sets',
        response: PostRequest.response,
        matchingRules: PostRequest.matchingRules,
      },
      'postApplicationServerSet'
    );

    cy.contains('Add').first().click();
    cy.get('header').should('contain', 'New');

    cy.fillTheForm(PostRequest.request);

    cy.usePactWait(['postApplicationServerSet'])
      .its('response.statusCode')
      .should('eq', 201);
  });

  it('edit ApplicationServerSet', () => {
    cy.usePactIntercept(
      {
        method: 'GET',
        url: '**/api/platform/application_server_sets/2',
        response: ApplicationServerSetItem,
      },
      'getApplicationServerSet-2'
    );

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: '**/api/platform/application_server_sets/2',
        response: PostRequest.response,
        matchingRules: PostRequest.matchingRules,
      },
      'putApplicationServerSet-2'
    );

    cy.get('[data-testid="EditIcon"]').eq(2).click();
    cy.get('header').should('contain', ApplicationServerSetItem.body.name);

    cy.fillTheForm(PostRequest.request);

    cy.usePactWait(['putApplicationServerSet-2'])
      .its('response.statusCode')
      .should('eq', 201);
  });

  it('edit ApplicationServerSet with no applicationServers should fail', () => {
    cy.usePactIntercept(
      {
        method: 'GET',
        url: '**/api/platform/application_server_sets/2',
        response: ApplicationServerSetItem,
      },
      'getApplicationServerSet-2'
    );

    cy.get('[data-testid="EditIcon"]').eq(2).click();
    cy.get('header').should('contain', ApplicationServerSetItem.body.name);

    const request = {
      ...PostRequest.request,
      applicationServers: [],
    };

    cy.fillTheForm(request);

    cy.contains('Save').click();

    cy.contains('Application Servers: Application servers cannot be empty');
  });

  it('delete ApplicationServerSet', () => {
    cy.intercept('DELETE', '**/api/platform/application_server_sets/1*', {
      statusCode: 204,
    }).as('deleteApplicationServerSet');

    cy.get('tbody')
      .get('button:has([data-testid="DeleteIcon"])')
      .eq(1)
      .should('be.disabled');
    cy.get('tbody').get('[data-testid="DeleteIcon"]').eq(2).click();

    cy.contains('Remove element');
    cy.get('div.MuiDialog-container button')
      .filter(':visible')
      .contains('Yes, delete it')
      .click();

    cy.usePactWait(['deleteApplicationServerSet'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
