import DashboardItem from '../../fixtures/My/Dashboard/getDashboard.json';

describe('Dashboard', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Dashobard');
    cy.before();

    cy.get('.welcome .card-container div h3').should(
      'contain',
      ' Ivoz Provider brand administrator portal'
    );
  });

  it('contains Client Information', () => {
    cy.get('.activity .title').should('contain', 'Brand information');

    Object.values(DashboardItem.body.brand).forEach((value, index) => {
      cy.get('div.row')
        .eq(index)
        .within(() => {
          cy.get('div').eq(1).should('have.text', value);
        });
    });
  });

  it('can go to ddis', () => {
    cy.get('div.card.amount')
      .eq(1)
      .within(() => {
        cy.get('a').click();
      });

    cy.contains('DDIs');
  });

  it('can go to carriers', () => {
    cy.get('div.card.amount')
      .eq(2)
      .within(() => {
        cy.get('a').click();
      });

    cy.contains('Carriers');
  });

  it('contains last added clients', () => {
    cy.get('.last .header .title').should('contain', 'Last added clients');

    const tableHead = ['Name', 'Type', 'SIP domain', 'Max calls'];
    tableHead.forEach((th, index) => {
      cy.get('div.card.last div.table table thead th')
        .eq(index)
        .should('contain.text', th);
    });

    const recentActivity = DashboardItem.body.recentActivity;

    recentActivity.forEach((activity, index) => {
      cy.get('div.card.last div.table table tbody tr')
        .eq(index)
        .within(() => {
          cy.get('th').should('contain.text', activity.name);
          cy.get('td').eq(0).should('contain.text', activity.type);
          cy.get('td').eq(1).should('contain.text', activity.domainUsers);
          cy.get('td').eq(2).should('contain.text', activity.maxCalls);
        });
    });
  });
});
