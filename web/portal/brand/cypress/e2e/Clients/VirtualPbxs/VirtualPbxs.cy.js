import ProfileItem from '../../../fixtures/My/Profile/getProfile.json';
import CompaniesCollection from '../../../fixtures/Provider/Companies/getCollection.json';
import { assertNoUsersImportAction } from '../utils/UsersImportAction';
import {
  deleteCompany,
  importUsers,
  postCompany,
  postWebPortal,
  putCompany,
} from './VirtualPbxs.tests';

describe('in Companies', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('vpbx');
    cy.before();

    cy.get('svg[data-testid="BusinessIcon"]').first().click();
    cy.contains('Virtual PBXs').click();

    cy.get('header').should('contain', 'Virtual PBXs');

    cy.get('table').should('contain', CompaniesCollection.body[0].id);
  });

  it('Impersonate enabled', () => {
    cy.usePactWait(['getWebPortals'])
      .its('response.statusCode')
      .should('eq', 200);

    cy.get('svg[data-testid="AdminPanelSettingsIcon"]')
      .first()
      .parent('button')
      .should('not.be.disabled');
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add Virtual Pbx Companies', postCompany);

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit Virtual Pbx Companies', putCompany);

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete Virtual Pbx Companies', deleteCompany);

  ///////////////////////
  // POST
  ///////////////////////
  it('post Web Portal', postWebPortal);

  ///////////////////////
  // Users mass import
  ///////////////////////
  it('import users from a CSV file', importUsers);
});

describe('in Companies as a restricted admin without import privileges', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('vpbx');
    cy.intercept('GET', '**/api/brand/my/profile*', {
      statusCode: 200,
      body: {
        ...ProfileItem.body,
        restricted: true,
        acls: [
          {
            iden: 'Companies',
            create: true,
            read: true,
            update: true,
            delete: true,
          },
          {
            iden: '_UsersMassImport',
            create: false,
            read: true,
            update: false,
            delete: false,
          },
        ],
      },
    });
    cy.before();

    cy.get('svg[data-testid="BusinessIcon"]').first().click();
    cy.contains('Virtual PBXs').click();

    cy.get('table').should('contain', CompaniesCollection.body[0].id);
  });

  it('hides the users import action', assertNoUsersImportAction);
});
