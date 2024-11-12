describe('RatingProfiles', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('RatingProfiles');
    cy.before();

    cy.contains('Billing').click();
    cy.contains('Rating profiles').click();

    cy.get('header').should('contain', 'Rating profiles');
    cy.get('[data-testid="CurrencyExchangeIcon"]').first().click();

    cy.get('[role="dialog"]').contains('Simulate call');
  });

  it('has disabled buttons', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/client/rating_profiles/1/simulate_call',
        response: {
          body: {
            plan: 'Something',
            callDate: '2023-01-24 10:51:44',
            duration: 20,
            patternName: 'Dest3 (+346)',
            connectionCharge: 0,
            intervalStart: '0',
            rate: 0.0025,
            ratePeriod: 1,
            totalCost: 0.15,
            currencySymbol: '€',
          },
          statusCode: 201,
        },
      },
      'postSimulateCall'
    );

    cy.get(`[role="dialog"] input`)
      .first()
      .clear()
      .type('+342654', { delay: 1 });
    cy.get(`[role="dialog"] input`).eq(1).clear().type(20, { delay: 1 });

    cy.get('[role="dialog"] button').contains('Accept').first().click();

    cy.usePactWait('postSimulateCall');

    cy.get('[role="dialog"] table').contains('Something');
  });
});
