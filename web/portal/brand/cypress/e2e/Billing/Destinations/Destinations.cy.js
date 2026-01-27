import DestinationCollection from '../../../fixtures/Provider/Destination/getCollection.json';
import destinationItem from '../../../fixtures/Provider/Destination/getItem.json';
import newDestination from '../../../fixtures/Provider/Destination/postItem.json';
import editDestination from '../../../fixtures/Provider/Destination/put.json';

describe('in Destination', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('destinations');
    cy.before();

    cy.get('svg[data-testid="WalletIcon"]').first().click();
    cy.contains('Destinations').click();

    cy.get('header').should('contain', 'Destinations');

    cy.get('table').should('contain', DestinationCollection.body[0].id);
  });

  it('add Destination', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/brand/destinations*',
        response: newDestination.response,
        matchingRules: newDestination.matchingRules,
      },
      'createDestination'
    );

    cy.contains('Add').first().click();
    const { ...rest } = newDestination.request;
    delete rest.destinationRateGroup;
    cy.fillTheForm({ ...rest });

    cy.get('header').should('contain', 'Destinations');
    cy.usePactWait('createDestination')
      .its('response.statusCode')
      .should('eq', 201);
  });

  it('edit Destination', () => {
    cy.usePactIntercept(
      {
        method: 'GET',
        url: '**/api/brand/destinations/1',
        response: { ...destinationItem },
      },
      'getDestination-1'
    );
    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/brand/destinations/${editDestination.response.body.id}`,
        response: editDestination.response,
      },
      'editDestination'
    );
    cy.get('svg[data-testid="EditIcon"]').first().click();
    const { ...rest } = newDestination.request;
    delete rest.prefix;
    cy.fillTheForm({ ...rest });
    cy.get('header').should('contain', 'Destinations');

    cy.usePactWait(['editDestination'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  it('delete Destination', () => {
    cy.intercept('DELETE', '**/api/brand/destinations/1', {
      statusCode: 204,
    }).as('deleteDestinationRate');

    cy.get('td button svg[data-testid="DeleteIcon"]').first().click();

    cy.contains('Remove element');
    cy.get('[role="dialog"]')
      .filter(':visible')
      .contains('Yes, delete it')
      .click();

    cy.get('header').should('contain', 'Destinations');

    cy.usePactWait(['deleteDestinationRate'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
