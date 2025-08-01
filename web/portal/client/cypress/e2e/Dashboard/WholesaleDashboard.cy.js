import DashboardItem from '../../fixtures/My/Dashboard/getWholesaleDashboard.json';
import { CLIENT_TYPE } from '../../support/commands/prepareGenericPactInterceptors';

describe('Dashboard Wholesale', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Dashobard-Wholesale', {
      clientType: CLIENT_TYPE.Wholesale,
    });
    cy.before();

    cy.get('.welcome .card-container div h3').should(
      'contain',
      'wholesale client portal'
    );
  });

  it('contains Client Information', () => {
    cy.get('.activity .title').should('contain', 'Client information');

    Object.values(DashboardItem.body.client).forEach((value, index) => {
      cy.get('div.row')
        .eq(index)
        .within(() => {
          cy.get('div').eq(1).should('have.text', value);
        });
    });
  });

  it('can go to Active Calls', () => {
    cy.get('div.card.amount')
      .eq(0)
      .within(() => {
        cy.get('a').click();
      });

    cy.contains('Active call');
  });

  it('contains last calls', () => {
    cy.get('.last .header .title').should('contain', 'Last Calls');

    const tableHead = ['Date', 'Caller', 'Callee', 'Duration'];
    tableHead.forEach((th, index) => {
      cy.get('div.card.last div.table table thead th')
        .eq(index)
        .should('contain.text', th);
    });

    const latestBillableCalls = DashboardItem.body.latestBillableCalls;

    latestBillableCalls.forEach((call, index) => {
      cy.get('div.card.last div.table table tbody tr')
        .eq(index)
        .within(() => {
          cy.get('th').should('contain.text', call.date);
          cy.get('td').eq(0).should('contain.text', call.caller);
          cy.get('td').eq(1).should('contain.text', call.callee);
          cy.get('td').eq(2).should('contain.text', call.duration);
        });
    });
  });
});
