import DestinationRateGroupCollection from '../../../fixtures/Provider/DestinationRateGroup/getCollection.json';
import destinationRateGroupItem from '../../../fixtures/Provider/DestinationRateGroup/getItem.json';
import newDestinationRateGroup from '../../../fixtures/Provider/DestinationRateGroup/postItem.json';
import editDestinationRateGroup from '../../../fixtures/Provider/DestinationRateGroup/put.json';

describe('in Destination Rates Group', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('DestinationRateGroup');
    cy.before();

    cy.get('svg[data-testid="WalletIcon"]').first().click();
    cy.contains('Destination rates').click();

    cy.get('header').should('contain', 'Destination rates');

    cy.get('table').should(
      'contain',
      DestinationRateGroupCollection.body[0].name['en']
    );
  });

  it('add Destination Rates Group', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/brand/destination_rate_groups*',
        response: newDestinationRateGroup.response,
        matchingRules: newDestinationRateGroup.matchingRules,
      },
      'createDestinationRateGroup'
    );
    cy.contains('Add').first().click();

    const { ...rest } = newDestinationRateGroup.request;
    delete rest.file;
    delete rest.importerArguments;

    cy.fillTheForm({ ...rest });

    cy.get('header').should('contain', 'Destination rates');
    cy.usePactWait('createDestinationRateGroup')
      .its('response.statusCode')
      .should('eq', 201);
  });

  it('edit Destination Rates Group', () => {
    cy.usePactIntercept(
      {
        method: 'GET',
        url: '**/api/brand/destination_rate_groups/2',
        response: { ...destinationRateGroupItem },
      },
      'getRatingPlanGroup-1'
    );

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/brand/destination_rate_groups/${editDestinationRateGroup.response.body.id}`,
        response: editDestinationRateGroup.response,
      },
      'editDestinationRateGroup'
    );

    cy.get('svg[data-testid="EditIcon"]').first().click();

    const { ...rest } = editDestinationRateGroup.request;
    delete rest.file;
    delete rest.importerArguments;

    cy.fillTheForm({ ...rest });
    cy.get('header').should('contain', 'Destination rates');

    cy.usePactWait(['editDestinationRateGroup'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  it('delete Destination Rates Group', () => {
    cy.intercept('DELETE', '**/api/brand/destination_rate_groups/1', {
      statusCode: 204,
    }).as('deleteDestinationRate');

    cy.get('td button svg[data-testid="MoreHorizIcon"]').eq(1).click();
    cy.get('li.MuiMenuItem-root').contains('Delete').click();

    cy.contains('Remove element');
    cy.get('[role="dialog"]')
      .filter(':visible')
      .contains('Yes, delete it')
      .click();

    cy.get('header').should('contain', 'Destination rates');

    cy.usePactWait(['deleteDestinationRate'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
