import CallerInTransformationsCollection from '../../../../fixtures/Provider/TransformationRule/getCollection.json';
import newCallerInTransformations from '../../../../fixtures/Provider/TransformationRule/post.json';

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

  it('edit disabled', () => {
    cy.get('[data-testid="EditIcon"]').should('not.be.enabled');
  });

  it('delete disabled', () => {
    cy.get('[data-testid="DeleteIcon"]').should('not.be.enabled');
  });
});
