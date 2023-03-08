import ExternalCallFilterCollection from '../../fixtures/ExternalCallFilter/getCollection.json';
import newExternalCallFilter from '../../fixtures/ExternalCallFilter/post.json';
import ExternalCallFilterItem from '../../fixtures/ExternalCallFilter/getItem.json';
import editExternalCallFilter from '../../fixtures/ExternalCallFilter/put.json';

describe('in ExternalCallFilter', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('ExternalCallFilter');
    cy.before();

    cy.contains('Filtros de entrada externo').click();

    cy.get('h3').should('contain', 'List of Filtros de entrada externo');

    cy.get('table').should(
      'contain',
      ExternalCallFilterCollection.body[0].name
    );
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add ExternalCallFilter', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/client/external_call_filters*',
        response: newExternalCallFilter.response,
        matchingRules: newExternalCallFilter.matchingRules,
      },
      'createExternalCallFilter'
    );

    cy.get('[aria-label=Add]').click();

    const {
      name,
      welcomeLocution,
      holidayEnabled,
      holidayLocution,
      holidayTargetType,
      holidayNumberCountry,
      holidayNumberValue,
      holidayExtension,
      holidayVoicemail,
      outOfScheduleEnabled,
      outOfScheduleLocution,
      outOfScheduleTargetType,
      outOfScheduleNumberCountry,
      outOfScheduleNumberValue,
      outOfScheduleExtension,
      outOfScheduleVoicemail,
    } = newExternalCallFilter.request;
    cy.fillTheForm({
      name,
      welcomeLocution,
      holidayEnabled,
      holidayLocution,
      holidayTargetType,
      holidayNumberCountry,
      holidayNumberValue,
      holidayExtension,
      holidayVoicemail,
      outOfScheduleEnabled,
      outOfScheduleLocution,
      outOfScheduleTargetType,
      outOfScheduleNumberCountry,
      outOfScheduleNumberValue,
      outOfScheduleExtension,
      outOfScheduleVoicemail,
    });

    cy.get('h3').should('contain', 'List of Filtros de entrada externo');

    cy.usePactWait('createExternalCallFilter')
      .its('response.statusCode')
      .should('eq', 201);
  });

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit ExternalCallFilter', () => {
    cy.intercept('GET', '**/api/client/external_call_filters/1', {
      ...ExternalCallFilterItem,
    }).as('getExternalCallFilter-1');

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/client/external_call_filters/${editExternalCallFilter.response.body.id}`,
        response: editExternalCallFilter.response,
      },
      'editExternalCallFilter'
    );

    cy.get('svg[data-testid="EditIcon"]').first().click();

    const {
      name,
      welcomeLocution,
      holidayEnabled,
      holidayLocution,
      holidayTargetType,
      holidayNumberCountry,
      holidayNumberValue,
      holidayExtension,
      holidayVoicemail,
      outOfScheduleEnabled,
      outOfScheduleLocution,
      outOfScheduleTargetType,
      outOfScheduleNumberCountry,
      outOfScheduleNumberValue,
      outOfScheduleExtension,
      outOfScheduleVoicemail,
    } = editExternalCallFilter.request;
    cy.fillTheForm({
      name,
      welcomeLocution,
      holidayEnabled,
      holidayLocution,
      holidayTargetType,
      holidayNumberCountry,
      holidayNumberValue,
      holidayExtension,
      holidayVoicemail,
      outOfScheduleEnabled,
      outOfScheduleLocution,
      outOfScheduleTargetType,
      outOfScheduleNumberCountry,
      outOfScheduleNumberValue,
      outOfScheduleExtension,
      outOfScheduleVoicemail,
    });

    cy.contains('List of Filtros de entrada externo');

    cy.usePactWait(['editExternalCallFilter'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete ExternalCallFilter', () => {
    cy.intercept('DELETE', '**/api/client/external_call_filters/*', {
      statusCode: 204,
    }).as('deleteExternalCallFilter');

    cy.get('td > a > svg[data-testid="DeleteIcon"]').first().click();

    cy.contains('Remove element');
    cy.get('div[role=dialog] button')
      .filter(':visible')
      .contains('Delete')
      .click();

    cy.get('h3').should('contain', 'List of Filtros de entrada externo');

    cy.usePactWait(['deleteExternalCallFilter'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
