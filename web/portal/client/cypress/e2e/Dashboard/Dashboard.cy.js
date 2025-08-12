import DashboardItem from '../../fixtures/My/Dashboard/getDashboard.json';

describe('Dashboard', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Dashobard');
    cy.before();

    cy.get('.welcome .card-container div h3').should(
      'contain',
      'vPBX client portal'
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

    cy.contains('Users');
  });

  it('can go to extensions', () => {
    cy.get('div.card.amount')
      .eq(1)
      .within(() => {
        cy.get('a').click();
      });

    cy.contains('Extensions');
  });

  it('can go to ddis', () => {
    cy.get('div.card.amount')
      .eq(2)
      .within(() => {
        cy.get('a').click();
      });

    cy.contains('DDIs');
  });

  it('contains last added users', () => {
    cy.get('.last .header .title').should('contain', 'Last added users');

    // Check the table headers
    const tableHead = ['Name', 'Last Name', 'Extension', 'Outgoing DDI'];
    tableHead.forEach((th, index) => {
      cy.get('div.card.last div.table table thead th')
        .eq(index)
        .should('contain.text', th);
    });

    const latestUsers = DashboardItem.body.latestUsers;

    latestUsers.forEach((user, index) => {
      // Check the table body for specific row contents
      cy.get('div.card.last div.table table tbody tr')
        .eq(index) // First row
        .within(() => {
          cy.get('th').should('contain.text', user.name);
          cy.get('td').eq(0).should('contain.text', user.lastName);
          cy.get('td').eq(1).should('contain.text', user.extension);
          cy.get('td').eq(2).should('contain.text', user.outgoingDdi);
        });
    });
  });
});
