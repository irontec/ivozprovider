import CallerInTransformationsCollection from '../../../../fixtures/Provider/TransformationRule/getCollection.json';
import CallerInTransformationsItem from '../../../../fixtures/Provider/TransformationRule/getItem.json';
import newCallerInTransformations from '../../../../fixtures/Provider/TransformationRule/post.json';
import editCallerInTransformations from '../../../../fixtures/Provider/TransformationRule/put.json';

describe('in Caller In Transformations', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Caller-in-transformations');
    cy.before('');

    cy.get('svg[data-testid="SettingsIcon"]').first().click();
    cy.contains('Numeric transformations').click();
    cy.get('svg[data-testid="MoveDownIcon"]').first().click();

    cy.get('header').should('contain', 'Caller In Transformations');

    cy.get('table').should(
      'contain',
      CallerInTransformationsCollection.body[0].id
    );
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add Caller In Transformations', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/brand/transformation_rules*',
        response: newCallerInTransformations.response,
        matchingRules: newCallerInTransformations.matchingRules,
      },
      'createNumericTransformation'
    );

    cy.get('[aria-label=Add]').click();

    const { ...rest } = newCallerInTransformations.request;

    delete rest.type;
    delete rest.transformationRuleSet;

    cy.fillTheForm(rest);

    cy.get('header').should('contain', 'Caller In Transformations');

    cy.usePactWait(['createNumericTransformation'])
      .its('response.statusCode')
      .should('eq', 201);
  });

  /////////////////////
  // PUT
  /////////////////////
  it('edit Caller In Transformations', () => {
    cy.intercept('GET', '**/api/brand/transformation_rules/1', {
      ...CallerInTransformationsItem,
    }).as('getNumericTransformation-1');

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/brand/transformation_rules/${editCallerInTransformations.response.body.id}`,
        response: editCallerInTransformations.response,
      },
      'editCallerInTransformations'
    );

    cy.get('svg[data-testid="EditIcon"]').eq(0).click();
    const { ...rest } = editCallerInTransformations.request;
    delete rest.type;
    delete rest.transformationRuleSet;

    cy.fillTheForm(rest);

    cy.usePactWait(['editCallerInTransformations'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  /////////////////////
  // DELETE
  /////////////////////
  it('delete Caller In Transformations', () => {
    cy.intercept('DELETE', '**/api/brand/transformation_rules/1', {
      statusCode: 204,
    }).as('deleteNumericTransformations');

    cy.get('td button > svg[data-testid="DeleteIcon"]').eq(0).click();

    cy.contains('Remove element');

    cy.get('div.MuiDialog-container button')
      .filter(':visible')
      .contains('Yes, delete it')
      .click();

    cy.get('header').should('contain', 'Caller In Transformations');

    cy.usePactWait(['deleteNumericTransformations'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
