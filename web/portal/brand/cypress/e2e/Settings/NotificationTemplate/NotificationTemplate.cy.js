import LanguageCollection from '../../../fixtures/Provider/Languages/getCollection.json';
import NotificationTemplateContentCollection from '../../../fixtures/Provider/NotificationTemplateContents/getCollection.json';
import NotificationTemplateCollection from '../../../fixtures/Provider/NotificationTemplates/getCollection.json';
import NotificationTemplateItem from '../../../fixtures/Provider/NotificationTemplates/getItem.json';
import newNotificationTemplate from '../../../fixtures/Provider/NotificationTemplates/post.json';
import editNotificationTemplate from '../../../fixtures/Provider/NotificationTemplates/put.json';

describe('in Notification templates', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Notification-templates');
    cy.before('');

    cy.get('svg[data-testid="SettingsIcon"]').first().click();
    cy.contains('Notification templates').click();

    cy.get('header').should('contain', 'Notification templates');

    cy.get('table').should(
      'contain',
      NotificationTemplateCollection.body[0].name
    );
  });

  it('View Notification Template Contents', () => {
    cy.intercept('GET', '**/api/brand/languages*', {
      ...LanguageCollection,
    }).as('getLanguages');

    cy.intercept('GET', '**/api/brand/notification_template_contents*', {
      ...NotificationTemplateContentCollection,
    }).as('getNotificationTemplateContents');

    cy.get('svg[data-testid="ArticleIcon"]').first().click();

    cy.usePactWait(['getNotificationTemplateContents'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add Notification Template', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/brand/notification_templates*',
        response: newNotificationTemplate.response,
        matchingRules: newNotificationTemplate.matchingRules,
      },
      'createNotificationTemplate'
    );

    cy.get('[aria-label=Add]').click();

    cy.fillTheForm(newNotificationTemplate.request);

    cy.get('header').should('contain', 'Notification templates');

    cy.usePactWait(['createNotificationTemplate'])
      .its('response.statusCode')
      .should('eq', 201);
  });

  /////////////////////
  // PUT
  /////////////////////
  it('edit Notification Template', () => {
    cy.intercept('GET', '**/api/brand/languages*', {
      ...LanguageCollection,
    }).as('getLanguages');

    cy.intercept('GET', '**/api/brand/notification_templates/1', {
      ...NotificationTemplateItem,
    }).as('getNotificationTemplate-1');

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/brand/notification_templates/${editNotificationTemplate.response.body.id}`,
        response: editNotificationTemplate.response,
      },
      'editNotificationTemplate'
    );

    cy.get('svg[data-testid="EditIcon"]').eq(0).click();
    const { ...rest } = editNotificationTemplate.request;
    delete rest.name;
    delete rest.type;

    cy.fillTheForm({ ...rest });

    cy.usePactWait(['editNotificationTemplate'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  /////////////////////
  // DELETE
  /////////////////////
  it('delete Notification Template', () => {
    cy.intercept('DELETE', '**/api/brand/notification_templates/1', {
      statusCode: 204,
    }).as('deleteNotificationTemplates');

    cy.get('td button > svg[data-testid="DeleteIcon"]').eq(0).click();

    cy.contains('Remove element');

    cy.get('[role="dialog"]')
      .filter(':visible')
      .contains('Yes, delete it')
      .click();

    cy.get('header').should('contain', 'Notification templates');

    cy.usePactWait(['deleteNotificationTemplates'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
