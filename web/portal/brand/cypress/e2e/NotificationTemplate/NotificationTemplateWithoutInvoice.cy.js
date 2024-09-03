import NotificationTemplateCollection from '../../fixtures/Provider/NotificationTemplates/getCollection.json';
import newNotificationTemplate from '../../fixtures/Provider/NotificationTemplates/post.json';

describe('in Notification Templates', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('NotificationTemplates', ['invoices']);
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
  it('cannot find invoices in NotificationTemplate', () => {
    cy.get('[aria-label=Add]').click();

    const { ...rest } = newNotificationTemplate.request;
    rest.type = 'invoice';

    cy.get(`div[id=mui-component-select-type]`).click();
    cy.get(`ul.MuiList-root li[data-value=${rest.type}]`).should('not.exist');
  });
});
