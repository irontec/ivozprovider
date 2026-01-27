import LocationCollection from '../../fixtures/Location/getCollection.json';
import LocationItem from '../../fixtures/Location/getItem.json';
import newLocation from '../../fixtures/Location/post.json';
import editLocation from '../../fixtures/Location/put.json';

describe('Location', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Location');
    cy.before();

    cy.contains('User configuration').click();
    cy.contains('Locations').click();

    cy.get('header').should('contain', 'Locations');

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

    const { name, description, userIds } = newLocation.request;
    cy.fillTheForm({
      name,
      description,
      userIds,
    });

    cy.get('header').should('contain', 'Locations');

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

    const { name, description, userIds } = editLocation.request;
    cy.fillTheForm({
      name,
      description,
      userIds,
    });

    cy.contains('Locations');

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

    cy.get('td button > svg[data-testid="DeleteIcon"]').first().click();

    cy.contains('Remove element');
    cy.get('[role="dialog"]')
      .filter(':visible')
      .contains('Yes, delete it')
      .click();

    cy.get('header').should('contain', 'Locations');

    cy.usePactWait(['deleteLocation'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
