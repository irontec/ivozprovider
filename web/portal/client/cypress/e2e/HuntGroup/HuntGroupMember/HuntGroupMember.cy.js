import HuntGroupMemberCollection from '../../../fixtures/HuntGroupMember/getCollection.json';
import {
  deleteHuntGroupMember,
  postHuntGroupMember,
} from '../../HuntGroupMember/HuntGroupMember.tests';

describe('HuntGroupMember', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('HuntGroup-HuntGroupMember');
    cy.before();

    cy.contains('Routing endpoints').click();
    cy.contains('Hunt Groups').click();

    cy.get('header').should('contain', 'Hunt Groups');

    cy.get('svg[data-testid="Groups3Icon"]').first().click();

    cy.get('table').should(
      'contain',
      HuntGroupMemberCollection.body[0].priority
    );
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add HuntGroupMember', postHuntGroupMember);

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete HuntGroupMember', deleteHuntGroupMember);
});
