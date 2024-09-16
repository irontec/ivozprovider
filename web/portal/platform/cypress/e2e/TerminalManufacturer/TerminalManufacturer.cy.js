import TerminalManufacturerCollection from '../../fixtures/TerminalManufacturer/getCollection.json';
import {
  deleteTerminalManufacturer,
  postTerminalManufacturer,
  putTerminalManufacturer,
} from './TerminalManufacturer.tests';

describe('in Terminal Manufacturer', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('TerminalManufacturer');
    cy.before();

    cy.contains('Terminal Manufacturers').click();

    cy.get('header').should('contain', 'Terminal Manufacturers');

    cy.get('table').should(
      'contain',
      TerminalManufacturerCollection.body[0].name
    );
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add Terminal Manufacturer', postTerminalManufacturer);

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit Terminal Manufacturer', putTerminalManufacturer);

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete Terminal Manufacturer', deleteTerminalManufacturer);
});
