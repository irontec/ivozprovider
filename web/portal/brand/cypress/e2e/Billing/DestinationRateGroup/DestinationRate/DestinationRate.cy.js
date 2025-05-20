import DestinationRatesCollection from '../../../../fixtures/Provider/DestinationRates/getCollection.json';
import newDestinationRates from '../../../../fixtures/Provider/DestinationRates/postItem.json';

describe('in Destination Rates', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('destinationRateGroup-rates');
    cy.before();

    cy.get('svg[data-testid="WalletIcon"]').first().click();
    cy.contains('Destination rates').click();
    cy.get('svg[data-testid="PaymentsIcon"]').eq(0).click();

    cy.get('header').should('contain', 'Rates');

    cy.get('table').should('contain', DestinationRatesCollection.body[0].id);
  });

  it('add Destination rate', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/brand/destination_rates*',
        response: newDestinationRates.response,
        matchingRules: newDestinationRates.matchingRules,
      },
      'createDestinationRate'
    );

    cy.contains('Add').first().click();

    const { ...rest } = newDestinationRates.request;
    delete rest.destinationRateGroup;

    cy.fillTheForm({ ...rest });

    cy.get('header').should('contain', 'Destination rates');
    cy.usePactWait('createDestinationRate')
      .its('response.statusCode')
      .should('eq', 201);
  });

  it('delete Destinatio Rate', () => {
    cy.intercept('DELETE', '**/api/brand/destination_rates/1', {
      statusCode: 204,
    }).as('deleteDestinationRate');

    cy.get('td button svg[data-testid="DeleteIcon"]').first().click();

    cy.contains('Remove element');
    cy.get('div.MuiDialog-container button')
      .filter(':visible')
      .contains('Yes, delete it')
      .click();

    cy.get('header').should('contain', 'Rates');

    cy.usePactWait(['deleteDestinationRate'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
