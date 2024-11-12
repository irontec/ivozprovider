import RatingProfiles from '../../../../fixtures/Provider/RatingProfile/getCollection.json';
import {
  deleteProfile,
  postProfile,
  putProfile,
} from '../../common/RatingProfile.tests';

describe('in Administrator', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('retails-client-rating-profiles');

    cy.before('');
    cy.contains('Clients').click();
    cy.contains('Retails').click();

    cy.get('header').should('contain', 'Retails');
    cy.get('td button svg[data-testid="MoreHorizIcon"]').eq(3).click();
    cy.get('li.MuiMenuItem-root').contains('Rating Profiles').click();
    cy.get('header').should('contain', 'Rating Profiles');

    cy.get('table').should('contain', RatingProfiles.body[0].ratingPlanGroup);
  });

  it('add RatingProfile', postProfile);

  it('edit RatingProfile', putProfile);

  it('delete RatingProfile', deleteProfile);
});
