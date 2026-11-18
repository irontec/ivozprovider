import ProfileItem from '../../../fixtures/My/Profile/getProfile.json';
import DdisCollection from '../../../fixtures/Provider/Ddis/getCollection.json';
import {
  assertNoDdisImportAction,
  deleteDdi,
  importDdis,
  postDdi,
  putDdi,
} from './Ddis.tests';

describe('in Ddis', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('DDIs');
    cy.before();

    cy.get('svg[data-testid="PrecisionManufacturingIcon"]').first().click();
    cy.contains('DDIs').click();

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
  it('import Ddis from a CSV file', importDdis);
});

describe('in Ddis as a restricted admin without create privileges', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('DDIs');
    cy.intercept('GET', '**/api/brand/my/profile*', {
      statusCode: 200,
      body: {
        ...ProfileItem.body,
        restricted: true,
        acls: [
          {
            iden: 'DDIs',
            create: false,
            read: true,
            update: true,
            delete: true,
          },
        ],
      },
    }).as('getRestrictedProfile');
    cy.before();

    cy.get('svg[data-testid="PrecisionManufacturingIcon"]').first().click();
    cy.contains('DDIs').click();

    cy.get('header').should('contain', 'DDIs');
    cy.get('table').should('contain', DdisCollection.body[0].id);
  });

  it('has no import action', assertNoDdisImportAction);
});
