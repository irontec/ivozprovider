import LanguageCollection from '../../../fixtures/Language/getCollection.json';
import NotificationTemplateCollection from '../../../fixtures/NotificationTemplate/getCollection.json';
import NotificationTemplateContentCollection from '../../../fixtures/NotificationTemplateContent/getCollection.json';

describe('in Default Notification Templates', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('default-notification-templates');
    cy.before('');

    cy.contains('Generic Configuration').click();
    cy.contains('Default Notification templates').click();

    cy.get('header').should('contain', 'Default Notification templates');

    cy.get('table').should(
      'contain',
      NotificationTemplateCollection.body[0].name
    );
  });

  it('View Notification Template Contents', () => {
    cy.intercept('GET', '**/api/platform/languages*', {
      ...LanguageCollection,
    }).as('getLanguages');

    cy.intercept('GET', '**/api/platform/notification_template_contents*', {
      ...NotificationTemplateContentCollection,
    }).as('getNotificationTemplateContents');

    cy.get('svg[data-testid="SubjectIcon"]').eq(0).first().click();

    cy.usePactWait(['getNotificationTemplateContents'])
      .its('response.statusCode')
      .should('eq', 200);
  });
});
