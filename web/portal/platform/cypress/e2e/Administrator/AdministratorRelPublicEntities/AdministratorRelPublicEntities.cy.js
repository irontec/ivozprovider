import AdministratorRelPublicEntitiesCollection from '../../../fixtures/AdministratorRelPublicEntities/getCollection.json';
import { putAdministratorRelPublicEntities } from './AdministratorRelPublicEntities.tests';

describe('in Administrator RelPublic Entities', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Administrator-relPublic-entities');
    cy.before();

    cy.contains('Main operators').click();
    cy.get('svg[data-testid="KeyIcon"]').eq(2).first().click();

    cy.get('header').should('contain', 'Administrator access privileges');

    cy.get('table').should(
      'contain',
      AdministratorRelPublicEntitiesCollection.body[0].publicEntity.iden
    );
  });

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit Administrator', putAdministratorRelPublicEntities);
});
