import DashboardItem from '../../fixtures/My/Dashboard/getResidentialDashboard.json';
import { CLIENT_TYPE } from '../../support/commands/prepareGenericPactInterceptors';

describe('Dashboard Residential', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Dashobard-Residential', {
      clientType: CLIENT_TYPE.Residential,
    });
    cy.before();

    cy.get('.welcome .card-container div h3').should(
      'contain',
      ' Ivoz Provider residential client portal'
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

  it('can go to Residential devices', () => {
    cy.get('div.card.amount')
      .eq(0)
      .within(() => {
        cy.get('a').click();
      });

    cy.contains('Residential Devices');
  });

  it('can go to voicemails', () => {
    cy.get('div.card.amount')
      .eq(1)
      .within(() => {
        cy.get('a').click();
      });

    cy.contains('Voicemails');
  });

  it('can go to ddis', () => {
    cy.get('div.card.amount')
      .eq(2)
      .within(() => {
        cy.get('a').click();
      });

    cy.contains('DDIs');
  });

  it('contains last added residential devices', () => {
    cy.get('.last .header .title').should(
      'contain',
      'Last added Residential Devices'
    );

    // Check the table headers
    const tableHead = ['Name', 'Description', 'Outgoing DDI'];
    tableHead.forEach((th, index) => {
      cy.get('div.card.last div.table table thead th')
        .eq(index)
        .should('contain.text', th);
    });

    const latestResidentialDevices =
      DashboardItem.body.latestResidentialDevices;

    latestResidentialDevices.forEach((account, index) => {
      cy.get('div.card.last div.table table tbody tr')
        .eq(index)
        .within(() => {
          cy.get('th').should('contain.text', account.name);
          cy.get('td').eq(0).should('contain.text', account.description);
          cy.get('td').eq(1).should('contain.text', account.outgoingDdi);
        });
    });
  });
});
