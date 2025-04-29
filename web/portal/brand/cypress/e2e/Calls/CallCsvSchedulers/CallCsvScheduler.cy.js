import CallCsvSchedulersCollection from '../../../fixtures/Provider/CallCsvScheduler/getCollection.json';
import {
  deleteteCallCsvSchedulers,
  postCallCsvSchedulers,
  putCallCsvSchedulers,
} from './CallCsvSchedulers.tests';

describe('in Call CSV Schedulers', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Call-Csv-Scheduler');
    cy.before();

    cy.get(`svg[data-testid="RingVolumeIcon"]`).click();
    cy.contains('Call CSV Schedulers').click();

    cy.get('header').should('contain', 'Call CSV Schedulers');

    cy.get('table').should('contain', CallCsvSchedulersCollection.body[0].id);
  });

  ////////////////////
  //POST
  ////////////////////
  it('post Call CSV Schedulers', postCallCsvSchedulers);
  ////////////////////
  //PUT
  ////////////////////
  it('edit Call CSV Schedulers', putCallCsvSchedulers);

  // /////////////////
  // // DELETE
  // /////////////////
  it('delete Call CSV Schedulers', deleteteCallCsvSchedulers);
});
