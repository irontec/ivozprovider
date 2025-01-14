import CarrierServerCollection from '../../../../fixtures/Provider/CarrierServer/getCollection.json';
import {
  deleteCarrierServer,
  postCarrierServer,
  putCarrierServer,
} from './CarrierServer.tests';

describe('in Carrier Servers', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Carriers-Carrier-Server');
    cy.before();

    cy.get('svg[data-testid="PrecisionManufacturingIcon"]').first().click();
    cy.contains('Carriers').click();
    cy.get('svg[data-testid="StorageIcon"]').first().click();

    cy.get('header').should('contain', 'Carrier servers');

    cy.get('table').should('contain', CarrierServerCollection.body[0].id);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add Carrier Server', postCarrierServer);

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit Carrier Server', putCarrierServer);

  ///////////////////////////////
  // DELETE
  ///////////////////////////////
  it('delete Carrier Server', deleteCarrierServer);
});
