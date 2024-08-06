import IvrEntrypCollection from '../../../fixtures/IvrEntry/getCollection.json';
import IvrEntryItem from '../../../fixtures/IvrEntry/getItem.json';
import newIvrEntry from '../../../fixtures/IvrEntry/post.json';
import editIvrEntryItem from '../../../fixtures/IvrEntry/put.json';

describe('IvrEntry', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('IVRs-IvrEntry');
    cy.before();

    cy.contains('Routing endpoints').click();
    cy.contains('IVRs').click();

    cy.get('header').should('contain', 'IVRs');

    cy.get('svg[data-testid="FormatListNumberedIcon"]').first().click();

    cy.get('table').should('contain', IvrEntrypCollection.body[0].displayName);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add IvrEntry', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/client/ivr_entries*',
        response: newIvrEntry.response,
        matchingRules: newIvrEntry.matchingRules,
      },
      'createIvrEntry'
    );

    cy.get('[aria-label=Add]').click();

    const { entry, welcomeLocution, displayName, routeType, extension } =
      newIvrEntry.request;
    cy.fillTheForm({
      entry,
      welcomeLocution,
      displayName,
      routeType,
      extension,
    });

    cy.get('header').should('contain', 'IVR entries');
    cy.usePactWait('createIvrEntry')
      .its('response.statusCode')
      .should('eq', 201);
  });

  // ///////////////////////////////
  // // PUT
  // ///////////////////////////////
  it('edit IvrEntry', () => {
    cy.intercept('GET', '**/api/client/ivr_entries/1', {
      ...IvrEntryItem,
    }).as('getIvrEntry-1');

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/client/ivr_entries/${editIvrEntryItem.response.body.id}`,
        response: editIvrEntryItem.response,
      },
      'editIvrEntryItem'
    );

    cy.get('svg[data-testid="EditIcon"]').first().click();

    const { entry, welcomeLocution, displayName, routeType, extension } =
      newIvrEntry.request;
    cy.fillTheForm({
      entry,
      welcomeLocution,
      displayName,
      routeType,
      extension,
    });

    cy.contains('IVRs');

    cy.usePactWait(['editIvrEntryItem'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete IvrEntry', () => {
    cy.intercept('DELETE', '**/api/client/ivr_entries/*', {
      statusCode: 204,
    }).as('deleteIvrEntry');

    cy.get('td button > svg[data-testid="DeleteIcon"]').first().click();
    cy.contains('Remove element');
    cy.get('div.MuiDialog-container button')
      .filter(':visible')
      .contains('Yes, delete it')
      .click();

    cy.get('header').should('contain', 'IVRs');
    cy.usePactWait(['deleteIvrEntry'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
