import LanguageCollection from '../../../../fixtures/Language/getCollection.json';
import NotificationTemplateContentsCollection from '../../../../fixtures/NotificationTemplateContent/getCollection.json';
import NotificationTemplateContentsItem from '../../../../fixtures/NotificationTemplateContent/getItem.json';
import editNotificationTemplateContents from '../../../../fixtures/NotificationTemplateContent/put.json';

describe('in Default Notification Template Contents', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors(
      'default-notification-templates-contents'
    );
    cy.before();

    cy.contains('Generic Configuration').click();
    cy.contains('Default Notification templates').click();
    cy.get('header').should('contain', 'Default Notification templates');
    cy.get('svg[data-testid="SubjectIcon"]').first().click();

    cy.get('table').should(
      'contain',
      NotificationTemplateContentsCollection.body[0].fromName
    );
  });

  it('edit Notification Template Contents', () => {
    cy.intercept('GET', '**/api/platform/languages*', {
      ...LanguageCollection,
    }).as('getLanguages');

    cy.intercept('GET', '**/api/platform/notification_template_contents/2', {
      ...NotificationTemplateContentsItem,
    }).as('getNotificationTemplateContents-2');

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/platform/notification_template_contents/${editNotificationTemplateContents.response.body.id}`,
        response: editNotificationTemplateContents.response,
      },
      'editNotificationTemplateContents'
    );

    cy.get('svg[data-testid="EditIcon"]').eq(0).first().click();
    const { ...rest } = editNotificationTemplateContents.request;
    delete rest.fromName;
    delete rest.fromAddress;
    delete rest.language;

    cy.fillTheForm({ ...rest });

    cy.usePactWait(['editNotificationTemplateContents'])
      .its('response.statusCode')
      .should('eq', 200);
  });
});
