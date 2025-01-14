import CallHistroryCollection from '../../fixtures/My/Calls/getCallHistory.json';
import DashboardItem from '../../fixtures/My/Dashboard/getDashboard.json';

describe('Dashboard', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Dashobard');
    cy.before();

    cy.get('.welcome .card-container div h3').should(
      'contain',
      ' Ivoz Provider vPBX user portal'
    );
  });

  it('contains User Information', () => {
    cy.get('.activity .title').should('contain', 'User information');

    Object.values(DashboardItem.body).forEach((value, index) => {
      cy.get('div.row')
        .eq(index)
        .within(() => {
          cy.get('div').eq(1).should('contain', value);
        });
    });
  });

  it('can go to Call forward settings', () => {
    cy.get('div.card.amount')
      .eq(0)
      .within(() => {
        cy.get('a').click();
      });

    cy.contains('Call forward settings');
  });

  it('can go to Inbound calls', () => {
    cy.get('div.card.amount')
      .eq(1)
      .within(() => {
        cy.get('a').click();
      });

    cy.contains('Calls');
  });

  it('can go to Outbound calls', () => {
    cy.get('div.card.amount')
      .eq(2)
      .within(() => {
        cy.get('a').click();
      });

    cy.contains('Calls');
  });

  it('contains Last Calls', () => {
    cy.get('.last .header .title').should('contain', 'Last Calls');

    const tableHead = ['Date', 'Caller', 'Callee', 'Duration'];
    tableHead.forEach((th, index) => {
      cy.get('div.card.last div.table table thead th')
        .eq(index)
        .should('contain.text', th);
    });

    const callHistory = CallHistroryCollection.body;

    callHistory.forEach((call, index) => {
      cy.get('div.card.last div.table table tbody tr')
        .eq(index)
        .within(() => {
          cy.get('th').should('contain.text', call.startTime);
          cy.get('td').eq(0).should('contain.text', call.caller);
          cy.get('td').eq(1).should('contain.text', call.callee);
          cy.get('td').eq(2).should('contain.text', call.duration);
        });
    });
  });
});
