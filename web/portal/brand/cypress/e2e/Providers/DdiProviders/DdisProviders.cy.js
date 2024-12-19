import DdisProvidersCollection from '../../../fixtures/Provider/DdiProviders/getCollection.json';
import {
  deleteDdiProviders,
  postDdiProviders,
  putDdiProviders,
} from './DdisProviders.tests';

describe('in Ddis Providers', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('DDIs-Providers');
    cy.before();

    cy.get('svg[data-testid="PrecisionManufacturingIcon"]').first().click();
    cy.contains('DDI Providers').click();

    cy.get('header').should('contain', 'DDI Providers');

    cy.get('table').should('contain', DdisProvidersCollection.body[0].id);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add Ddi Providers', postDdiProviders);

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit Ddi Providers', putDdiProviders);

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete Ddi Providers', deleteDdiProviders);
});
