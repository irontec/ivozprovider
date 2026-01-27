import ExternalCallFilterCollection from '../../../fixtures/ExternalCallFilter/getCollection.json';
import ExternalCallFilterItem from '../../../fixtures/ExternalCallFilter/getItem.json';
import newExternalCallFilter from '../../../fixtures/ExternalCallFilter/post.json';
import editExternalCallFilter from '../../../fixtures/ExternalCallFilter/put.json';
import { CLIENT_TYPE } from '../../../support/commands/prepareGenericPactInterceptors';

describe('ExternalCallFilter', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('ExternalCallFilter-Residential', {
      clientType: CLIENT_TYPE.Residential,
    });
    cy.before();

    cy.contains('External call filters').click();

    cy.get('header').should('contain', 'External call filters');

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
      blackListIds,
      outOfScheduleEnabled,
      outOfScheduleNumberValue,
      outOfScheduleNumberCountry,
    } = newExternalCallFilter.request;
    cy.fillTheForm({
      name,
      blackListIds,
      outOfScheduleEnabled,
      outOfScheduleNumberValue,
      outOfScheduleNumberCountry,
    });

    cy.get('header').should('contain', 'External call filters');

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
      blackListIds,
      outOfScheduleEnabled,
      outOfScheduleNumberValue,
      outOfScheduleNumberCountry,
    } = editExternalCallFilter.request;
    cy.fillTheForm({
      name,
      blackListIds,
      outOfScheduleEnabled,
      outOfScheduleNumberValue,
      outOfScheduleNumberCountry,
    });

    cy.contains('External call filters');

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

    cy.get('td button > svg[data-testid="DeleteIcon"]').first().click();

    cy.contains('Remove element');
    cy.get('[role="dialog"]')
      .filter(':visible')
      .contains('Yes, delete it')
      .click();

    cy.get('header').should('contain', 'External call filters');

    cy.usePactWait(['deleteExternalCallFilter'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
