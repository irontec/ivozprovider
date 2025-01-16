import ServicesCollection from '../../../fixtures/Services/getCollection.json';
import { putServices } from './Services.tests';

describe('in Services', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Services');
    cy.before();

    cy.contains('Generic Configuration').click();
    cy.contains('Services').click();

    cy.get('header').should('contain', 'Services');

    cy.get('table').should('contain', ServicesCollection.body[0].iden);
  });

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit Services', putServices);
});
