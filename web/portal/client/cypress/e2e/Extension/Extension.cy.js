import ExtensionCollection from '../../fixtures/Extension/getCollection.json';
import ExtensionItem from '../../fixtures/Extension/getItem.json';
import newExtension from '../../fixtures/Extension/post.json';
import editExtension from '../../fixtures/Extension/put.json';

describe('Extension', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Extension');
    cy.before();

    cy.contains('Extensions').click();

    cy.get('header').should('contain', 'Extensions');

    cy.get('table').should('contain', ExtensionCollection.body[0].name);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add Extension', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/client/extensions*',
        response: newExtension.response,
        matchingRules: newExtension.matchingRules,
      },
      'createExtension'
    );

    cy.get('[aria-label=Add]').click();

    const { number, routeType } = newExtension.request;
    cy.fillTheForm({
      number,
      routeType,
    });

    cy.get('header').should('contain', 'Extensions');

    cy.usePactWait('createExtension')
      .its('response.statusCode')
      .should('eq', 201);
  });

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit Extension', () => {
    cy.intercept('GET', '**/api/client/extensions/1', {
      ...ExtensionItem,
    }).as('getExtension-1');

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/client/extensions/${editExtension.response.body.id}`,
        response: editExtension.response,
      },
      'editExtension'
    );

    cy.get('svg[data-testid="EditIcon"]').first().click();

    const { number, routeType, user } = editExtension.request;
    cy.fillTheForm({
      number,
      routeType,
      user,
    });

    cy.contains('Extensions');

    cy.usePactWait(['editExtension'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete Extension', () => {
    cy.intercept('DELETE', '**/api/client/extensions/*', {
      statusCode: 204,
    }).as('deleteExtension');

    cy.get(
      'td > div.actions-cell > span > button:has(svg[data-testid="DeleteIcon"])'
    )
      .first()
      .click();

    cy.contains('Remove element');

    cy.get('div[role=dialog] button')
      .should('be.visible')
      .contains('Yes, delete it')
      .click({ force: true });

    cy.get('header').should('contain', 'Extensions');

    cy.usePactWait(['deleteExtension'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
