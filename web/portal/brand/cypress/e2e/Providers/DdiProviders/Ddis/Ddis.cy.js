import DdiProviderItem from '../../../../fixtures/Provider/DdiProviders/getItem.json';
import DdisCollection from '../../../../fixtures/Provider/Ddis/getCollection.json';
import { assertNoDdisImportAction } from '../../Ddis/Ddis.tests';
import { deleteDdi, postDdi, putDdi } from './Ddis.tests';

describe('in Ddi Providers DDIs', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('DDIs');
    cy.intercept('GET', '**/api/brand/ddi_providers/1', {
      ...DdiProviderItem,
    }).as('getDdiProvider-1');
    cy.before();

    cy.get('svg[data-testid="PrecisionManufacturingIcon"]').first().click();
    cy.contains('DDI Providers').click();

    cy.get('td button svg[data-testid="MoreHorizIcon"]').first().click();
    cy.get('li.MuiMenuItem-root').contains('DDIs').click();
    cy.get('header').should('contain', 'DDIs');

    cy.get('table').should('contain', DdisCollection.body[0].id);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add Ddi', postDdi);

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit Ddi', putDdi);

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete Ddi', deleteDdi);

  ///////////////////////
  // Mass import
  ///////////////////////
  it('has no import action', assertNoDdisImportAction);
});
