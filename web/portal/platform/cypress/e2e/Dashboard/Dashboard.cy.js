import DashboardItem from '../../fixtures/My/Dashboard/getDashboard.json';

describe('Dashboard', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Dashobard');
    cy.before();

    cy.get('.welcome .card-container div h3').should(
      'contain',
      ' Ivoz Provider global administrator portal'
    );
  });

  it('contains Client Information', () => {
    cy.get('.activity .title').should('contain', 'Operator information');

    Object.values(DashboardItem.body.admin).forEach((value, index) => {
      cy.get('div.row')
        .eq(index)
        .within(() => {
          cy.get('div').eq(1).should('have.text', value);
        });
    });
  });

  it('can go to brands', () => {
    cy.get('div.card.amount')
      .eq(0)
      .within(() => {
        cy.get('a').click();
      });

    cy.contains('Brands');
  });

  it('cannot go to clients', () => {
    cy.get('div.card.amount')
      .eq(1)
      .within(() => {
        cy.get('a').should('not.exist');
      });
  });

  it('cannot go to Users', () => {
    cy.get('div.card.amount')
      .eq(2)
      .within(() => {
        cy.get('a').should('not.exist');
      });
  });

  it('contains Last added brands', () => {
    cy.get('.last .header .title').should('contain', 'Last added brands');

    const tableHead = ['Name', 'TIN', 'SIP domain', 'Max Calls'];
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
          cy.get('td').eq(0).should('contain.text', activity.nif);
          cy.get('td').eq(1).should('contain.text', activity.sipDomain);
          cy.get('td').eq(2).should('contain.text', activity.maxCalls);
        });
    });
  });
});
