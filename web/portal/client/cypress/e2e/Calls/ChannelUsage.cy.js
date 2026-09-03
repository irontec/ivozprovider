import ChannelUsageCollection from '../../fixtures/ChannelUsage/getCollection.json';

const DAY_MS = 24 * 60 * 60 * 1000;

const searchParams = (url) => new URL(url).searchParams;

const parseApiDateTime = (value) => new Date(value.replace(' ', 'T'));

describe('ChannelUsage', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('ChannelUsage');
    cy.before();

    cy.contains('Calls').click();
    cy.contains('Channel usage').click();

    cy.get('header').should('contain', 'Channel usage');
  });

  it('requests the last 24 hours ordered by timestamp', () => {
    cy.get('button[value="day"]').should('have.class', 'Mui-selected');

    cy.wait('@getChannelUsages').then(({ request }) => {
      const params = searchParams(request.url);

      expect(params.get('_order[timestamp]')).to.eq('ASC');
      expect(params.get('_pagination')).to.eq('false');

      const from = parseApiDateTime(params.get('timestamp[after]'));
      const to = parseApiDateTime(params.get('timestamp[before]'));

      expect(to - from).to.be.closeTo(DAY_MS, 60000);
    });
  });

  it('summarises the period in the stat tiles', () => {
    cy.contains('.MuiPaper-outlined', 'Max usage')
      .find('h4')
      .should('have.text', '30');

    cy.contains('.MuiPaper-outlined', 'Average usage')
      .find('h4')
      .should('have.text', '13.50');

    cy.contains('.MuiPaper-outlined', 'Blocked calls')
      .find('h4')
      .should('have.text', '6');
  });

  it('draws every series of the combined chart', () => {
    cy.get('.MuiChartsAxis-directionX').should('have.length', 1);

    [
      'Blocked by client limit',
      'Max usage',
      'Average usage',
      'Channel limit',
    ].forEach((label) => {
      cy.contains('.MuiChip-root', label).should('be.visible');
    });

    cy.get('path.MuiAreaElement-series-peak').should('exist');
    cy.get('path.MuiLineElement-series-average').should('exist');
    cy.get('path.MuiLineElement-series-limit').should('exist');
    cy.get('rect.MuiBarElement-root').should('exist');
  });

  it('isolates a series when its legend entry is clicked', () => {
    cy.contains('.MuiChip-root', 'Average usage').click();

    cy.get('path.MuiLineElement-series-average').should('exist');
    cy.get('path.MuiAreaElement-series-peak').should('not.exist');
    cy.get('rect.MuiBarElement-root').should('not.exist');

    cy.contains('.MuiChip-root', 'Average usage').click();

    cy.get('path.MuiAreaElement-series-peak').should('exist');
    cy.get('rect.MuiBarElement-root').should('exist');
  });

  it('shows one chart per series in the split view', () => {
    cy.contains('button', 'Split').click();

    cy.get('.MuiChartsAxis-directionX').should('have.length', 3);
    cy.contains('.MuiChip-root', 'Channel limit').should('not.exist');
  });

  it('requests a wider window when another preset is selected', () => {
    cy.intercept('GET', '**/api/client/channel_usages?*', {
      ...ChannelUsageCollection,
    }).as('getWeekChannelUsages');

    cy.contains('button', 'Last 7 days').click();

    cy.wait('@getWeekChannelUsages').then(({ request }) => {
      const params = searchParams(request.url);
      const from = parseApiDateTime(params.get('timestamp[after]'));
      const to = parseApiDateTime(params.get('timestamp[before]'));

      expect(to - from).to.be.closeTo(7 * DAY_MS, 60000);
    });
  });

  it('reports an empty period', () => {
    cy.intercept('GET', '**/api/client/channel_usages?*', {
      ...ChannelUsageCollection,
      body: [],
    }).as('getEmptyChannelUsages');

    cy.contains('button', 'Last 30 days').click();

    cy.contains('There is no data for the selected period');
    cy.get('.MuiChartsAxis-directionX').should('not.exist');
  });

  it('reports a failed request', () => {
    cy.intercept('GET', '**/api/client/channel_usages?*', {
      statusCode: 500,
      body: {},
    }).as('getFailedChannelUsages');

    cy.contains('button', 'Last 30 days').click();

    cy.contains('Channel usage data could not be loaded');
  });
});
