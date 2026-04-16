import { EntityValue } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import WebhookIcon from '@mui/icons-material/Webhook';

import { WebhookProperties, WebhookPropertyList } from './WebhookProperties';

const properties: WebhookProperties = {
  name: {
    label: _('Name'),
    maxLength: 64,
  },
  description: {
    label: _('Description'),
    maxLength: 255,
  },
  uri: {
    label: _('URL'),
  },
  eventStart: {
    label: _('Start'),
    default: 0,
  },
  eventRing: {
    label: _('Ringing'),
    default: 0,
  },
  eventAnswer: {
    label: _('Answer'),
    default: 0,
  },
  eventEnd: {
    label: _('End'),
    default: 0,
  },
  template: {
    label: _('Template'),
    format: 'textarea',
    helpText: _(
      'Valid JSON with {{placeholder}} substitution. Available: {{event}}, {{brandId}}, {{companyId}}, {{ddiId}}, {{ddiE164}}, {{callId}}, {{uniqueId}}, {{caller}}, {{callee}}, {{dialStatus}}, {{timestamp}}.'
    ),
    default:
      '{\n' +
      '    "event": {{event}},\n' +
      '    "brandId": {{brandId}},\n' +
      '    "companyId": {{companyId}},\n' +
      '    "ddiId": {{ddiId}},\n' +
      '    "ddiE164": {{ddiE164}},\n' +
      '    "callId": {{callId}},\n' +
      '    "uniqueId": {{uniqueId}},\n' +
      '    "caller": {{caller}},\n' +
      '    "callee": {{callee}},\n' +
      '    "dialStatus": {{dialStatus}},\n' +
      '    "timestamp": {{timestamp}}\n' +
      '}',
  },
  company: {
    label: _('Client_one'),
  },
  ddi: {
    label: _('DDI_one'),
  },
};

const Webhook: EntityInterface = {
  ...defaultEntityBehavior,
  icon: WebhookIcon,
  iden: 'Webhook',
  title: _('Webhook', { count: 2 }),
  path: '/webhooks',
  toStr: (row: WebhookPropertyList<EntityValue>) => `${row.name}`,
  properties,
  columns: [
    'name',
    'uri',
    'eventStart',
    'eventRing',
    'eventAnswer',
    'eventEnd',
    'description',
  ],
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'Webhooks',
  },
  defaultOrderBy: '',
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
};

export default Webhook;
