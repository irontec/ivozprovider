import DashboardItem from '../../fixtures/My/Dashboard/getDashboard.json';

describe('Dashboard Retail', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Dashobard-Retail', {
      clientType: 'retail',
    });
    cy.before();

    cy.get('.welcome .card-container div h3').should(
      'contain',
      ' Ivoz Provider retail client portal'
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

  it('can go to users', () => {
    cy.get('div.card.amount')
      .eq(0)
      .within(() => {
        cy.get('a').click();
      });

    cy.contains('Retail Accounts');
  });

  it('can go to ddis', () => {
    cy.get('div.card.amount')
      .eq(1)
      .within(() => {
        cy.get('a').click();
      });

    cy.contains('DDIs');
  });

  it('can go to active calls', () => {
    cy.get('div.card.amount')
      .eq(2)
      .within(() => {
        cy.get('a').click();
      });

    cy.contains('Active call');
  });

  it('contains last added retail accounts', () => {
    cy.get('.last .header .title').should(
      'contain',
      'Last added Retail Accounts'
    );

    // Check the table headers
    const tableHead = ['Name', 'Description', 'Outgoing DDI'];
    tableHead.forEach((th, index) => {
      cy.get('div.card.last div.table table thead th')
        .eq(index)
        .should('contain.text', th);
    });

    const latestRetailAccounts = DashboardItem.body.latestRetailAccounts;

    latestRetailAccounts.forEach((account, index) => {
      // Check the table body for specific row contents
      cy.get('div.card.last div.table table tbody tr')
        .eq(index) // First row
        .within(() => {
          cy.get('th').should('contain.text', account.name);
          cy.get('td').eq(1).should('contain.text', account.description);
          cy.get('td').eq(2).should('contain.text', account.outgoingDdi);
        });
    });
  });
});
