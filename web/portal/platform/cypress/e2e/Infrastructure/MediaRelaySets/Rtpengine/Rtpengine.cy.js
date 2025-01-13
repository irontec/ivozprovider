import RtpengineCollection from '../../../../fixtures/Rtpengine/getCollection.json';
import {
  deleteRtpengine,
  postRtpengine,
  putRtpengine,
} from './Rtpengine.tests';

describe('in Rtpengine', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Rtpengine');
    cy.before();

    cy.contains('Infrastructure').click();
    cy.contains('Media Relay Sets').click();
    cy.get('td button > svg[data-testid="PlayLessonIcon"]').first().click();

    cy.get('header').should('contain', 'Media Relays');
    cy.get('table').should('contain', RtpengineCollection.body[0].id);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add Media Relay Sets', postRtpengine);

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit Media Relay Sets', putRtpengine);

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete Media Relay Sets', deleteRtpengine);
});
