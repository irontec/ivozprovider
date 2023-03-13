import LocationCollection from '../../fixtures/Location/getCollection.json';
import newLocation from '../../fixtures/Location/post.json';
import LocationItem from '../../fixtures/Location/getItem.json';
import editLocation from '../../fixtures/Location/put.json';

describe('in Location', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Location');
    cy.before();

    cy.contains('Location').click();

    cy.get('h3').should('contain', 'List of Location');

    cy.get('table').should('contain', LocationCollection.body[0].name);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add Location', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/client/locations*',
        response: newLocation.response,
        matchingRules: newLocation.matchingRules,
      },
      'createLocation'
    );

    cy.get('[aria-label=Add]').click();

    const { name, description } = newLocation.request;
    cy.fillTheForm({
      name,
      description,
    });

    cy.get('h3').should('contain', 'List of Location');

    cy.usePactWait('createLocation')
      .its('response.statusCode')
      .should('eq', 201);
  });

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit Location', () => {
    cy.intercept('GET', '**/api/client/locations/1', {
      ...LocationItem,
    }).as('getLocation-1');

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/client/locations/${editLocation.response.body.id}`,
        response: editLocation.response,
      },
      'editLocation'
    );

    cy.get('svg[data-testid="EditIcon"]').first().click();

    const { name, description } = editLocation.request;
    cy.fillTheForm({
      name,
      description,
    });

    cy.contains('List of Location');

    cy.usePactWait(['editLocation'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete Location', () => {
    cy.intercept('DELETE', '**/api/client/locations/*', {
      statusCode: 204,
    }).as('deleteLocation');

    cy.get('td > a > svg[data-testid="DeleteIcon"]').first().click();

    cy.contains('Remove element');
    cy.get('div[role=dialog] button')
      .filter(':visible')
      .contains('Delete')
      .click();

    cy.get('h3').should('contain', 'List of Location');

    cy.usePactWait(['deleteLocation'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
