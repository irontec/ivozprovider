import IvrCollection from '../../fixtures/Ivr/getCollection.json';
import newIvr from '../../fixtures/Ivr/post.json';
import IvrItem from '../../fixtures/Ivr/getItem.json';
import editIvr from '../../fixtures/Ivr/put.json';

describe('in Ivr', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Ivr');
    cy.before();

    cy.contains('IVRs').click();

    cy.get('h3').should('contain', 'List of IVRs');

    cy.get('table').should('contain', IvrCollection.body[0].name);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add Ivr', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/client/ivrs*',
        response: newIvr.response,
        matchingRules: newIvr.matchingRules,
      },
      'createIvr'
    );

    cy.get('[aria-label=Add]').click();

    const {
      name,
      timeout,
      maxDigits,
      welcomeLocution,
      successLocution,
      allowExtensions,
      noInputLocution,
      noInputRouteType,
      noInputNumberCountry,
      noInputNumberValue,
      noInputExtension,
      noInputVoicemail,
      errorLocution,
      errorRouteType,
      errorNumberCountry,
      errorNumberValue,
      errorExtension,
      errorVoicemail,
    } = newIvr.request;
    cy.fillTheForm({
      name,
      timeout,
      maxDigits,
      welcomeLocution,
      successLocution,
      allowExtensions,
      noInputLocution,
      noInputRouteType,
      noInputNumberCountry,
      noInputNumberValue,
      noInputExtension,
      noInputVoicemail,
      errorLocution,
      errorRouteType,
      errorNumberCountry,
      errorNumberValue,
      errorExtension,
      errorVoicemail,
    });

    cy.get('h3').should('contain', 'List of IVRs');

    cy.usePactWait('createIvr').its('response.statusCode').should('eq', 201);
  });

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit Ivr', () => {
    cy.intercept('GET', '**/api/client/ivrs/1', {
      ...IvrItem,
    }).as('getIvr-1');

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/client/ivrs/${editIvr.response.body.id}`,
        response: editIvr.response,
      },
      'editIvr'
    );

    cy.get('svg[data-testid="EditIcon"]').first().click();

    const {
      name,
      timeout,
      maxDigits,
      welcomeLocution,
      successLocution,
      allowExtensions,
      noInputLocution,
      noInputRouteType,
      noInputNumberCountry,
      noInputNumberValue,
      noInputExtension,
      noInputVoicemail,
      errorLocution,
      errorRouteType,
      errorNumberCountry,
      errorNumberValue,
      errorExtension,
      errorVoicemail,
    } = editIvr.request;
    cy.fillTheForm({
      name,
      timeout,
      maxDigits,
      welcomeLocution,
      successLocution,
      allowExtensions,
      noInputLocution,
      noInputRouteType,
      noInputNumberCountry,
      noInputNumberValue,
      noInputExtension,
      noInputVoicemail,
      errorLocution,
      errorRouteType,
      errorNumberCountry,
      errorNumberValue,
      errorExtension,
      errorVoicemail,
    });

    cy.contains('List of IVRs');

    cy.usePactWait(['editIvr']).its('response.statusCode').should('eq', 200);
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete Ivr', () => {
    cy.intercept('DELETE', '**/api/client/ivrs/*', {
      statusCode: 204,
    }).as('deleteIvr');

    cy.get('td > a > svg[data-testid="DeleteIcon"]').first().click();

    cy.contains('Remove element');
    cy.get('div[role=dialog] button')
      .filter(':visible')
      .contains('Delete')
      .click();

    cy.get('h3').should('contain', 'List of IVRs');

    cy.usePactWait(['deleteIvr']).its('response.statusCode').should('eq', 204);
  });
});
