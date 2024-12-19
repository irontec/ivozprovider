import DdisProvidersAddressesCollection from '../../../../fixtures/Provider/DdiProviders/getProviderAddressesCollection.json';
import {
  deleteDdiProviders,
  postDdiProvidersAddresses,
  putDdiProvidersAddresses,
} from './DDIProviderAddresses.tests';

describe('in Ddis Provider Addresses', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('DDIs-Providers-Addresses');
    cy.before();

    cy.get('svg[data-testid="PrecisionManufacturingIcon"]').first().click();
    cy.contains('DDI Providers').click();

    cy.get('svg[data-testid="DnsIcon"]').first().click();
    cy.get('header').should('contain', 'DDI Providers');

    cy.get('table').should(
      'contain',
      DdisProvidersAddressesCollection.body[0].id
    );
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add Ddi Providers Addresses', postDdiProvidersAddresses);

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit Ddi Providers', putDdiProvidersAddresses);

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete Ddi Providers', deleteDdiProviders);
});
