import ExtensionCollection from '../../fixtures/Extension/getCollection.json';
import newExtension from '../../fixtures/Extension/post.json';
import ExtensionItem from '../../fixtures/Extension/getItem.json';
import editExtension from '../../fixtures/Extension/put.json';

describe('in Extension', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Extension');
    cy.before();

    cy.contains('Extension').click();

    cy.get('h3').should('contain', 'List of Extensiones');

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

    cy.fillTheForm(newExtension.request);

    cy.get('h3').should('contain', 'List of Extensiones');

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

    cy.fillTheForm(editExtension.request);

    cy.contains('List of Extensiones');

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

    cy.get('td > a > svg[data-testid="DeleteIcon"]').first().click();

    cy.contains('Remove element');
    cy.get('div[role=dialog] button')
      .filter(':visible')
      .contains('Delete')
      .click();

    cy.get('h3').should('contain', 'List of Extensiones');

    cy.usePactWait(['deleteExtension'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
