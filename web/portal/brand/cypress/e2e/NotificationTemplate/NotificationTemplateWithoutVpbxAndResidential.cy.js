import NotificationTemplateCollection from '../../fixtures/Provider/NotificationTemplates/getCollection.json';
import newNotificationTemplate from '../../fixtures/Provider/NotificationTemplates/post.json';

describe('in Notification Templates', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('NotificationTemplates', [
      'vpbx',
      'residential',
    ]);
    cy.before();

    cy.get('svg[data-testid="SettingsIcon"]').first().click();
    cy.contains('Notification templates').click();

    cy.get('header').should('contain', 'Notification templates');

    cy.get('table').should(
      'contain',
      NotificationTemplateCollection.body[0].name
    );
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('cannot find fax in NotificationTemplate', () => {
    cy.get('[aria-label=Add]').click();

    const { ...rest } = newNotificationTemplate.request;
    rest.type = 'fax';

    cy.get(`div[id=mui-component-select-type]`).click();
    cy.get(`ul.MuiList-root li[data-value=${rest.type}]`).should('not.exist');
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('cannot find voicemail in NotificationTemplate', () => {
    cy.get('[aria-label=Add]').click();

    const { ...rest } = newNotificationTemplate.request;
    rest.type = 'voicemail';

    cy.get(`div[id=mui-component-select-type]`).click();
    cy.get(`ul.MuiList-root li[data-value=${rest.type}]`).should('not.exist');
  });
});
