import CallCsvReportCollection from '../../../../fixtures/Provider/CallCsvReport/getCollection.json';
import CallCsvReportItem from '../../../../fixtures/Provider/CallCsvReport/getItem.json';

describe('in Call CSV Schedulers', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Call-Csv-Report');
    cy.before();

    cy.get(`svg[data-testid="RingVolumeIcon"]`).click();
    cy.contains('Call CSV Schedulers').click();
    cy.get(`svg[data-testid="SummarizeIcon"]`).click();

    cy.get('header').should('contain', 'Call CSV Reports');

    cy.get('table').should('contain', CallCsvReportCollection.body[0].id);
  });

  it('View details', () => {
    cy.intercept('GET', '**/api/brand/call_csv_reports/*', {
      ...CallCsvReportItem,
    }).as('getBillableCall-1');

    cy.get('svg[data-testid="PanoramaIcon"]').first().click();

    cy.usePactWait(['getBillableCall-1'])
      .its('response.statusCode')
      .should('eq', 200);
  });
});
