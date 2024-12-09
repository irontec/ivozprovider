import CarriersCollection from '../../../fixtures/Provider/Carriers/getCollection.json';
import { postCarrier, putCarrier } from './Carriers.tests';

describe('in Carriers', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Carriers');
    cy.before();

    cy.get('svg[data-testid="PrecisionManufacturingIcon"]').first().click();
    cy.contains('Carriers').click();

    cy.get('header').should('contain', 'Carriers');

    cy.get('table').should('contain', CarriersCollection.body[0].name);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add Carrier', postCarrier);

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit Carrier', putCarrier);
});
