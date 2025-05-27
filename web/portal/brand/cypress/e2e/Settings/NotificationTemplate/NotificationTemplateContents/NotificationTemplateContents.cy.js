import LanguageCollection from '../../../../fixtures/Provider/Languages/getCollection.json';
import NotificationTemplateContentsCollection from '../../../../fixtures/Provider/NotificationTemplateContents/getCollection.json';
import NotificationTemplateContentsItem from '../../../../fixtures/Provider/NotificationTemplateContents/getItem.json';
import editNotificationTemplateContents from '../../../../fixtures/Provider/NotificationTemplateContents/put.json';

describe('in Default Notification Template Contents', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors(
      'default-notification-templates-contents'
    );
    cy.before();

    cy.get('svg[data-testid="SettingsIcon"]').first().click();
    cy.contains('Notification template').click();
    cy.get('svg[data-testid="SettingsIcon"]').first().click();
    cy.get('svg[data-testid="ArticleIcon"]').first().click();

    cy.get('header').should('contain', 'Notification template contents');

    cy.get('table').should(
      'contain',
      NotificationTemplateContentsCollection.body[0].fromName
    );
  });

  //////////////////////
  // PUT
  //////////////////////
  it('edit Notification Template Contents', () => {
    cy.intercept('GET', '**/api/brand/languages*', {
      ...LanguageCollection,
    }).as('getLanguages');

    cy.intercept('GET', '**/api/brand/notification_template_contents/2', {
      ...NotificationTemplateContentsItem,
    }).as('getNotificationTemplateContents-2');

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/brand/notification_template_contents/${editNotificationTemplateContents.response.body.id}`,
        response: editNotificationTemplateContents.response,
      },
      'editNotificationTemplateContents'
    );

    cy.get('svg[data-testid="EditIcon"]').eq(0).click();
    const { ...rest } = editNotificationTemplateContents.request;
    delete rest.fromName;
    delete rest.fromAddress;
    delete rest.language;

    cy.fillTheForm({ ...rest });

    cy.usePactWait(['editNotificationTemplateContents'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete Notification Template Contents', () => {
    cy.intercept('DELETE', '**/api/brand/notification_template_contents/2', {
      statusCode: 204,
    }).as('deleteNotificationTemplateContents');

    cy.get('td button > svg[data-testid="DeleteIcon"]').eq(0).click();

    cy.contains('Remove element');

    cy.get('div.MuiDialog-container button')
      .filter(':visible')
      .contains('Yes, delete it')
      .click();

    cy.get('header').should('contain', 'Notification template contents');

    cy.usePactWait(['deleteNotificationTemplateContents'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
