import CorporationsCollection from '../../fixtures/Provider/Corporations/getCollection.json';
import CorporationItem from '../../fixtures/Provider/Corporations/getItem.json';
import newCorporation from '../../fixtures/Provider/Corporations/post.json';
import editCorporation from '../../fixtures/Provider/Corporations/put.json';

describe('in Corporations', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Corporation');
    cy.before();

    cy.get('svg[data-testid="RoomPreferencesIcon"]').first().click();
    cy.contains('Corporations').click();

    cy.get('header').should('contain', 'Corporations');

    cy.get('table').should('contain', CorporationsCollection.body[0].name);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add Corporation', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/brand/corporations*',
        response: newCorporation.response,
        matchingRules: newCorporation.matchingRules,
      },
      'createCorporation'
    );

    cy.get('[aria-label=Add]').click();

    const { ...rest } = newCorporation.request;

    cy.fillTheForm(rest);

    cy.get('header').should('contain', 'Corporations');

    cy.usePactWait(['createCorporation'])
      .its('response.statusCode')
      .should('eq', 201);
  });

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit a Corporation', () => {
    cy.usePactIntercept(
      {
        method: 'GET',
        url: '**/api/brand/corporations/1',
        response: { ...CorporationItem },
      },
      'getCorporation-1'
    );

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/brand/corporations/${editCorporation.response.body.id}`,
        response: editCorporation.response,
      },
      'editCorporation'
    );

    cy.get('svg[data-testid="EditIcon"]').first().click();

    const { ...rest } = editCorporation.request;

    cy.fillTheForm(rest);

    cy.get('header').should('contain', 'Corporations');

    cy.usePactWait(['editCorporation'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete Corporation', () => {
    cy.intercept('DELETE', '**/api/brand/corporations/1', {
      statusCode: 204,
    }).as('deleteCorporation');

    cy.get('td button > svg[data-testid="DeleteIcon"]').first().click();

    cy.contains('Remove element');

    cy.get('[role="dialog"]')
      .filter(':visible')
      .contains('Yes, delete it')
      .click();

    cy.get('header').should('contain', 'Corporations');

    cy.usePactWait(['deleteCorporation'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
