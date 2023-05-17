import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { CompanyProperties } from './CompanyProperties';
import TypeIcon from './Field/TypeIcon';
import Actions from './Action';

const properties: CompanyProperties = {
  type: {
    label: _('Type'),
    enum: {
      vpbx: _('Vpbx'),
      retail: _('Retail'),
      wholesale: _('Wholesale', { count: 1 }),
      residential: _('Residential', { count: 1 }),
    },
  },
  name: {
    label: _('Name'),
  },
  domainUsers: {
    label: _('SIP domain'),
    maxLength: 190,
  },
  maxCalls: {
    label: _('Max calls'),
    default: 10,
    helpText: _(
      'Limits external incoming and outgoing calls to this value (0 for unlimited).'
    ),
  },
  maxDailyUsage: {
    label: _('Max daily usage'),
    default: 1000000,
    helpText: _('Limit max daily usage.'),
  },
  maxDailyUsageEmail: {
    label: _('Email'),
    maxLength: 100,
    helpText: _(
      'Used to notify if max daily usage has been reached. Leave empty to avoid notification.'
    ),
  },
  invoicing: {},
  'invoicing.nif': {
    label: _('Nif'),
    required: false,
  },
  'invoicing.postalAddress': {
    label: _('Postal address'),
    required: false,
  },
  'invoicing.postalCode': {
    label: _('Postal code'),
    required: false,
  },
  'invoicing.town': {
    label: _('Town'),
    required: false,
  },
  'invoicing.province': {
    label: _('Province'),
    required: false,
  },
  'invoicing.countryName': {
    label: _('Country', { count: 1 }),
    required: false,
  },
  ipfilter: {
    label: _('Filter by IP address'),
    default: 0,
    enum: {
      '0': _('No'),
      '1': _('yes'),
    },
    visualToggle: {
      '0': {
        show: [],
        hide: ['geoIpAllowedCountries'],
      },
      '1': {
        show: ['geoIpAllowedCountries'],
        hide: [],
      },
    },
    helpText: _(
      'Add IPs or network if enabled. Otherwise all calls will be rejected.'
    ),
  },
  onDemandRecord: {
    label: _('On-demand call recording'),
    enum: {
      '0': _('Disabled'),
      '1': _('Enabled (SIP INFO)'),
      '2': _('Enabled (SIP INFO + DTMFs)'),
    },
    visualToggle: {
      '0': {
        show: [],
        hide: ['onDemandRecordCode'],
      },
      '1': {
        show: [],
        hide: ['onDemandRecordCode'],
      },
      '2': {
        show: ['onDemandRecordCode'],
        hide: [],
      },
    },
  },
  onDemandRecordCode: {
    label: _('Code'),
    maxLength: 3,
    prefix: <span className="asterisc">*</span>,
    pattern: new RegExp('[0-9*]+'),
  },
  allowRecordingRemoval: {
    label: _('Allow Client to remove recordings'),
    default: 1,
    enum: {
      '0': _('No'),
      '1': _('Yes'),
    },
    helpText: _(
      "Enable this option to display delete button in Client's portal call recordings section."
    ),
  },
  recordingsLimitMb: {
    label: _('Max disk usage (in MB)'),
    //@TODO nullIfEmpty: true
    minimum: 0,
    helpText: _(
      'Max disk usage in megabytes this company can use. When limit has been reached, oldest recordings will be removed. Leave empty to allow unlimited disk usage.'
    ),
  },
  recordingsLimitEmail: {
    label: _('Disk usage notification email'),
    maxLength: 250,
    helpText: _(
      'Email address that will be notified when 80% of the configured limit has been reached.'
    ),
  },
  featureIds: {
    label: _('Feature', { count: 20 }),
    type: 'array',
    null: _('There are not associated elements'),
    $ref: '#/definitions/Feature',
    visualToggle: {
      retail: {
        show: ['domainUsers'],
        hide: ['domainUsers'],
      },
      residential: {
        show: ['domainUsers'],
        hide: ['domainUsers'],
      },
      recordings: {
        show: [
          'recordingsLimitMb',
          'recordingsDiskUsage',
          'recordingsLimitEmail',
          'onDemandRecord',
          'allowRecordingRemoval',
        ],
        hide: ['faxNotificationTemplate'],
      },
      faxes: {
        show: ['faxNotificationTemplate'],
        hide: ['faxNotificationTemplate'],
      },
      invoices: {
        show: [
          'invoiceNotificationTemplate',
          'postalAddress',
          'postalCode',
          'town',
          'province',
          'countryName',
          'registryData',
        ],
        hide: [
          'invoiceNotificationTemplate',
          'postalAddress',
          'postalCode',
          'town',
          'province',
          'countryName',
          'registryData',
        ],
      },
    },
  },
  recordingsDiskUsage: {
    label: _('Disk usage'),
    //@TODO IvozProvider_Klear_Ghost_Recordings::getCompanyDiskUsage
  },
  externallyextraopts: {
    label: _('Externally rater custom options'),
    format: 'textarea',
  },
  billingMethod: {
    label: _('Billing method'),
    enum: {
      postpaid: _('Postpaid'),
      prepaid: _('Prepaid'),
      pseudoprepaid: _('Pseudo-prepaid'),
      none: _('None'),
    },
  },
  balance: {
    label: _('Balance'),
    //@TODO IvozProvider_Klear_Ghost_Companies::getBalance
  },
  currentDayUsage: {
    label: _('Today usage'),
    //@TODO IvozProvider_Klear_Ghost_Companies::getCurrentDayUsage
  },
  accountStatus: {
    label: _('Status'),
    //@TODO IvozProvider_Klear_Ghost_Companies::getAccountStatus
  },
  currentDayMaxUsage: {
    label: _('Max daily usage'),
    //@TODO: IvozProvider_Klear_Ghost_Companies::getCurrentDayMaxUsage
  },
  typeIcon: {
    label: _('Type'),
    component: TypeIcon,
  },
  showInvoices: {
    label: _('Display billing details to client'),
    default: 0,
    enum: {
      '0': _('No'),
      '1': _('Yes'),
    },
    helpText: _(
      "Enable this option to display billing details in Client's portal (e.g. invoices, prices, etc.)."
    ),
  },
  language: {
    label: _('Language', { count: 1 }),
    default: 1,
  },
  defaultTimezone: {
    label: _('Default timezone'),
    default: 145,
  },
  country: {
    label: _('Country code'),
    default: 70,
  },
  currency: {
    label: _('Currency', { count: 1 }),
    null: _('Default currency'),
    default: '__null__',
  },
  distributeMethod: {
    label: _('Distribute method'),
    default: 'hash',
    enum: {
      static: _('Static'),
      rr: _('Round Robin'),
      hash: _('Hash based'),
    },
    visualToggle: {
      static: {
        show: ['applicationServer'],
        hide: [],
      },
      rr: {
        show: [],
        hide: ['applicationServer'],
      },
      hash: {
        show: [],
        hide: ['applicationServer'],
      },
    },
  },
  applicationServer: {
    label: _('Application Server'),
    default: '__null__',
    null: _('Unassigned'),
  },
  transformationRuleSet: {
    label: _('Numeric transformation', { count: 1 }),
  },
  outgoingDdi: {
    label: _('Outgoing DDI'),
    null: _('Unassigned'),
    default: '__null__',
  },
  outgoingDdiE164: {
    //TODO IvozProvider_Klear_Ghost_Companies::getDdiE164
  },
  outgoingDdiRule: {
    label: _('Outgoing DDI Rule', { count: 1 }),
    null: _('Unassigned'),
    default: '__null__',
    helpText: _(
      "Default outgoing DDI. This can be overriden in caller's edit screen."
    ),
  },
  voicemailNotificationTemplate: {
    label: _('Voicemail Notification'),
    null: _('Use generic template'),
    default: '__null__',
  },
  faxNotificationTemplate: {
    label: _('Fax Notification'),
    null: _('Use generic template'),
    default: '__null__',
  },
  invoiceNotificationTemplate: {
    label: _('Invoice Notification'),
    null: _('Use generic template'),
    default: '__null__',
  },
  callCsvNotificationTemplate: {
    label: _('Call CSV Notification'),
    null: _('Use generic template'),
    default: '__null__',
  },
  maxDailyUsageNotificationTemplate: {
    label: _('Max daily Notification'),
    null: _('Use generic template'),
    default: '__null__',
  },
  geoIpAllowedCountries: {
    label: _('GeoIP allowed countries'),
    helpText: _(
      'Select a country to allow all IPs. Leave it blank if you want to allow just specific IP/ranges.'
    ),
    type: 'array',
    $ref: '#/definitions/Country',
  },
  routingTagIds: {
    label: _('Routing Tag', { count: 2 }),
    type: 'array',
    $ref: '#/definitions/RoutingTag',
  },
  codecIds: {
    label: _('Audio Transcoding'),
    helpText: _('Do NOT select any codec before reading documentation.'), //@TODO add link
    type: 'array',
    $ref: '#/definitions/Codec',
  },
  corporation: {
    label: _('Corporations'),
    null: _('Not configured'),
    default: '__null__',
  },
};

const Company: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'Company',
  title: _('Company', { count: 2 }),
  path: '/companies',
  toStr: (row: any) => row.name,
  properties,
  columns: [
    'name',
    'invoicing.nif',
    'billingMethod',
    'outgoingDdi',
    'domainUsers',
    'featureIds',
  ],
  customActions: Actions,
  selectOptions,
  foreignKeyGetter,
  Form,
};

export default Company;
