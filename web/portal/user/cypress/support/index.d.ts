declare namespace Cypress {
  interface Chainable {
    /**
     * Custom command to select DOM element by data-cy attribute.
     * @example cy.fillTheForm(newItem)
     */
    fillTheForm(value: T): Chainable<Element>;
    before(): Chainable<Element>;
    prepareGenericPactInterceptors(value: T): Chainable<Element>;
  }
}
