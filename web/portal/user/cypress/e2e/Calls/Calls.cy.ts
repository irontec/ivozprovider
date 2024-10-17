import MyCallHistoryCollection from '../../fixtures/My/Calls/getCallHistory.json';

describe('Calls', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('User-Calls');
    cy.before();

    cy.get('svg[data-testid="ChatBubbleIcon"]').first().click();

    cy.get('table').should('contain', MyCallHistoryCollection.body[0].id);
  });

  it('Download', () => {
    cy.intercept('GET', '**/api/user/my/call_history?_pagination=false', {
      ...MyCallHistoryCollection,
    }).as('getCallHistory');

    cy.get('svg[data-testid="CloudDownloadIcon"]').click();

    cy.usePactWait(['getCallHistory'])
      .its('response.statusCode')
      .should('eq', 200);
  });
});
