import { EntityValue } from '@irontec/ivoz-ui';
import _ from 'lodash';

import { CompanyPropertyList } from '../../../../src/entities/Company/CompanyProperties';
import FeaturesCollection from '../../../fixtures/Provider/Features/getCollection.json';

export enum MODE {
  EDIT = 'edit',
  NEW = 'new',
}
interface RequestProps {
  mode: MODE;
  request: CompanyPropertyList<EntityValue>;
  response?: {
    body: CompanyPropertyList<EntityValue>;
    statusCode: number;
  };
}

interface TestCompanyProps extends RequestProps {
  hasBillingFeature: boolean;
  hasInvoicingFeature: boolean;
  hasRecordingFeature: boolean;
  removeFields: Array<string>;
}

export const testPbx = (props: TestCompanyProps) => {
  const { request, mode } = props;
  const featureIds = request.featureIds as unknown as Array<number>;

  const testCompanyProps = {
    request,
    mode,
    hasBillingFeature: _hasBillingFeature(featureIds),
    hasInvoicingFeature: _hasInvoicingFeature(featureIds),
    hasRecordingFeature: _hasRecordingFeature(featureIds),
    removeFields: [
      'type',
      'balance',
      'routingTagIds',
      'codecIds',
      'distributeMethod',
      'recordingsLimitMB',
      'applicationServer',
      'mediaRelaySets',
      'recordingsLimitEmail',
      'geoIpAllowedCountries',
      'currentDayUsage',
      'currentDayMaxUsage',
      'accountStatus',
      'balance',
      'domainName',
    ],
  };
  const type = request.type;

  switch (type) {
    case 'vpbx':
      _testVpbxCompany(testCompanyProps);
      break;
    case 'residential':
      _testResidentialCompany(testCompanyProps);
      break;
    case 'retail':
      _testRetailCompany(testCompanyProps);
      break;
    default:
      break;
  }
};

const _testVpbxCompany = (props: TestCompanyProps) => {
  const {
    mode,
    hasBillingFeature,
    hasInvoicingFeature,
    hasRecordingFeature,
    request,
    removeFields,
  } = props;
  const company = request;

  if (!hasBillingFeature) {
    removeFields.push(
      ...[
        'billingMethod',
        'maxDailyUsageNotificationTemplate',
        'externallyextraopts',
      ]
    );
  }

  if (mode === MODE.NEW) {
    removeFields.push(
      ...[
        'outgoingDdi',
        'outgoingDdiRule',
        'voicemailNotificationTemplate',
        'faxNotificationTemplate',
        'invoiceNotificationTemplate',
        'callCsvNotificationTemplate',
        'maxDailyUsageNotificationTemplate',
        'accessCredentialNotificationTemplate',
        'externallyextraopts',
        'showInvoices',
        'invoicing',
        'onDemandRecord',
        'onDemandRecordCode',
        'allowRecordingRemoval',
      ]
    );
  }

  if (!hasInvoicingFeature) {
    removeFields.push(
      ...['showInvoices', 'invoicing', 'invoiceNotificationTemplate']
    );
  }

  if (!hasRecordingFeature) {
    removeFields.push(
      ...['onDemandRecord', 'onDemandRecordCode', 'allowRecordingRemoval']
    );
  }

  if (!company.ipfilter) {
    removeFields.push('geoIpAllowedCountries');
  }

  if (company.distributeMethod !== 'static') {
    removeFields.push('geoIpAllowedCountries');
  }

  const form = _.omit(company, removeFields);

  cy.fillTheForm(form);
};

const _testResidentialCompany = (props: TestCompanyProps) => {
  const {
    mode,
    hasBillingFeature,
    hasInvoicingFeature,
    hasRecordingFeature,
    removeFields,
    request,
  } = props;
  const company = request;

  if (mode === MODE.NEW) {
    removeFields.push(
      ...[
        'codecIds',
        'onDemandRecord',
        'allowRecordingRemoval',
        'voicemailNotificationTemplate',
        'faxNotificationTemplate',
        'invoiceNotificationTemplate',
        'callCsvNotificationTemplate',
        'maxDailyUsageNotificationTemplate',
        'accessCredentialNotificationTemplate',
        'externallyextraopts',
        'showInvoices',
        'invoicing',
        'onDemandRecord',
        'onDemandRecordCode',
        'allowRecordingRemoval',
      ]
    );
  }

  if (!hasRecordingFeature) {
    removeFields.push(
      ...['onDemandRecord', 'onDemandRecordCode', 'allowRecordingRemoval']
    );
  }

  if (!hasInvoicingFeature) {
    removeFields.push('invoicing', 'invoiceNotificationTemplate');
  }

  if (!hasBillingFeature) {
    removeFields.push(
      ...['externallyextraopts', 'maxDailyUsageNotificationTemplate']
    );
  }

  const form = _.omit(company, removeFields);
  cy.fillTheForm(form);
};

const _testRetailCompany = (props: TestCompanyProps) => {
  const {
    mode,
    hasBillingFeature,
    hasInvoicingFeature,
    hasRecordingFeature,
    removeFields,
    request,
  } = props;
  const company = request;

  removeFields.push(...['voicemailNotificationTemplate']);
  if (mode === MODE.NEW) {
    removeFields.push(
      ...[
        'onDemandRecord',
        'allowRecordingRemoval',
        'onDemandRecordCode',
        'showInvoices',
        'invoicing',
      ]
    );
  }

  if (!hasRecordingFeature) {
    removeFields.push(
      ...['onDemandRecord', 'onDemandRecordCode', 'allowRecordingRemoval']
    );
  }

  if (!hasInvoicingFeature) {
    removeFields.push('invoicing', 'invoiceNotificationTemplate');
  }

  if (!hasBillingFeature) {
    removeFields.push(
      ...['externallyextraopts', 'maxDailyUsageNotificationTemplate']
    );
  }

  const form = _.omit(company, removeFields);
  cy.fillTheForm(form);
};

const _hasBillingFeature = (featureIds?: Array<number>): boolean => {
  if (!featureIds) {
    return false;
  }

  const billingFeature = FeaturesCollection.body.find(
    (element) => element.iden === 'bililng'
  );

  if (!billingFeature) {
    return false;
  }

  return featureIds.includes(billingFeature.id);
};

const _hasInvoicingFeature = (featureIds?: Array<number>): boolean => {
  if (!featureIds) {
    return false;
  }

  const invoicingFeature = FeaturesCollection.body.find(
    (element) => element.iden === 'invoices'
  );

  if (!invoicingFeature) {
    return false;
  }

  return featureIds.includes(invoicingFeature.id);
};

const _hasRecordingFeature = (featureIds?: Array<number>): boolean => {
  if (!featureIds) {
    return false;
  }

  const recordingFeature = FeaturesCollection.body.find(
    (element) => element.iden === 'recordings'
  );

  if (!recordingFeature) {
    return false;
  }

  return featureIds.includes(recordingFeature.id);
};
