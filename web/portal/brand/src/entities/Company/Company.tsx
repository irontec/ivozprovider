import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { CompanyProperties } from './CompanyProperties';
import foreignKeyResolver from './ForeignKeyResolver';

const properties: CompanyProperties = {
  'type': {
    label: _('Type'),
    enum: {
      'vpbx' : _('Vpbx'),
      'retail' : _('Retail'),
      'wholesale' : _('Wholesale'),
      'residential' : _('Residential'),
    },
  },
  'name': {
    label: _('Name'),
  },
  'domainUsers': {
    label: _('Domain Users'),
  },
  'nif': {
    label: _('Nif'),
  },
  'maxCalls': {
    label: _('Max Calls'),
  },
  'maxDailyUsage': {
    label: _('Max DailyUsage'),
  },
  'maxDailyUsageEmail': {
    label: _('Max DailyUsageEmail'),
  },
  'postalAddress': {
    label: _('Postal Address'),
  },
  'postalCode': {
    label: _('Postal Code'),
  },
  'town': {
    label: _('Town'),
  },
  'province': {
    label: _('Province'),
  },
  'countryName': {
    label: _('Country Name'),
  },
  'ipfilter': {
    label: _('Ipfilter'),
  },
  'onDemandRecord': {
    label: _('On DemandRecord'),
  },
  'onDemandRecordCode': {
    label: _('On DemandRecordCode'),
  },
  'externallyextraopts': {
    label: _('Externallyextraopts'),
  },
  'billingMethod': {
    label: _('Billing Method'),
    enum: {
      'postpaid' : _('Postpaid'),
      'prepaid' : _('Prepaid'),
      'pseudoprepaid' : _('Pseudoprepaid'),
    },
  },
  'balance': {
    label: _('Balance'),
  },
  'showInvoices': {
    label: _('Show Invoices'),
  },
  'id': {
    label: _('Id'),
  },
  'language': {
    label: _('Language'),
  },
  'defaultTimezone': {
    label: _('Default Timezone'),
  },
  'country': {
    label: _('Country'),
  },
  'currency': {
    label: _('Currency'),
  },
  'transformationRuleSet': {
    label: _('Transformation RuleSet'),
  },
  'outgoingDdi': {
    label: _('Outgoing Ddi'),
  },
  'voicemailNotificationTemplate': {
    label: _('Voicemail NotificationTemplate'),
  },
  'faxNotificationTemplate': {
    label: _('Fax NotificationTemplate'),
  },
  'invoiceNotificationTemplate': {
    label: _('Invoice NotificationTemplate'),
  },
  'callCsvNotificationTemplate': {
    label: _('Call CsvNotificationTemplate'),
  },
  'featureIds': {
    label: _('Feature Ids'),
  },
};

const Company: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'Company',
  title: _('Company', { count: 2 }),
  path: '/Companies',
  toStr: (row: any) => row.id,
  properties,
  selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default Company;