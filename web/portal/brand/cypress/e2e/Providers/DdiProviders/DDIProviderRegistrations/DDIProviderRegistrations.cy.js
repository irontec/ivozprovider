import DdisProvidersRegistrationsCollection from '../../../../fixtures/Provider/DdiProviders/getProviderRegistrationsCollection.json';
import {
  deleteDdiProvidersRegistrations,
  postDdiProvidersRegistrations,
  putDdiProvidersRegistrations,
} from './DDIProviderRegistrations.tests';

describe('in Ddis Provider Registrations', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('DDIs-Providers-Registrations');
    cy.before();

    cy.get('svg[data-testid="PrecisionManufacturingIcon"]').first().click();
    cy.contains('DDI Providers').click();

    cy.get('td button svg[data-testid="MoreHorizIcon"]').first().click();
    cy.get('li.MuiMenuItem-root')
      .contains('DDI Provider Registrations')
      .click();
    cy.get('header').should('contain', 'DDI Provider Registrations');

    cy.get('table').should(
      'contain',
      DdisProvidersRegistrationsCollection.body[0].username
    );
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add Ddi Providers Registrations', postDdiProvidersRegistrations);

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit Ddi Providers Registrations', putDdiProvidersRegistrations);

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete Ddi Providers Registrations', deleteDdiProvidersRegistrations);
});
