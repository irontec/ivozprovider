import NumericTransformationsCollection from '../../../fixtures/Provider/TransformationRuleSets/getCollection.json';
import NumericTransformationItem from '../../../fixtures/Provider/TransformationRuleSets/getItem.json';
import newNumericTransformation from '../../../fixtures/Provider/TransformationRuleSets/post.json';
import editNumericTransformation from '../../../fixtures/Provider/TransformationRuleSets/put.json';

describe('in Numeric transformations', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Numeric-transformations');
    cy.before('');

    cy.get('svg[data-testid="SettingsIcon"]').first().click();
    cy.contains('Numeric transformations').click();

    cy.get('header').should('contain', 'Numeric transformations');

    cy.get('table').should(
      'contain',
      NumericTransformationsCollection.body[0].id
    );
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add Numeric transformations', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/brand/transformation_rule_sets*',
        response: newNumericTransformation.response,
        matchingRules: newNumericTransformation.matchingRules,
      },
      'createNumericTransformation'
    );

    cy.get('[aria-label=Add]').click();

    const { ...rest } = newNumericTransformation.request;

    delete rest.trunkPrefix;
    delete rest.areaCode;

    cy.fillTheForm(rest);

    cy.get('header').should('contain', 'Numeric transformations');

    cy.usePactWait(['createNumericTransformation'])
      .its('response.statusCode')
      .should('eq', 201);
  });

  ////////////////////
  // PUT
  ////////////////////
  it('edit Numeric transformations', () => {
    cy.intercept('GET', '**/api/brand/transformation_rule_sets/1', {
      ...NumericTransformationItem,
    }).as('getNumericTransformation-1');

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/brand/transformation_rule_sets/${editNumericTransformation.response.body.id}`,
        response: editNumericTransformation.response,
      },
      'editNumericTransformation'
    );

    cy.get('svg[data-testid="EditIcon"]').eq(0).click();
    const { ...rest } = editNumericTransformation.request;
    delete rest.trunkPrefix;
    delete rest.areaCode;

    cy.fillTheForm(rest);

    cy.usePactWait(['editNumericTransformation'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  /////////////////////
  // DELETE
  /////////////////////
  it('delete Numeric transformations', () => {
    cy.intercept('DELETE', '**/api/brand/transformation_rule_sets/1', {
      statusCode: 204,
    }).as('deleteNumericTransformations');

    cy.get('td button svg[data-testid="MoreHorizIcon"]').first().click();
    cy.get('li.MuiMenuItem-root').contains('Delete').click();

    cy.contains('Remove element');

    cy.get('div.MuiDialog-container button')
      .filter(':visible')
      .contains('Yes, delete it')
      .click();

    cy.get('header').should('contain', 'Numeric transformations');

    cy.usePactWait(['deleteNumericTransformations'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
