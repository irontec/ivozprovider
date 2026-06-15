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
  callDirection: {
    label: _('Direction'),
    enum: {
      inbound: _('Inbound'),
      outbound: _('Outbound'),
      both: _('Both'),
    },
    default: 'both',
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
  eventUpdateClid: {
    label: _('Update CLID'),
    default: 0,
  },
  template: {
    label: _('Template'),
    format: 'textarea',
    helpText: _(
      'Valid JSON with {{placeholder}} substitution. Available: {{event}}, {{callId}}, {{direction}}, {{owner}}, {{party}}, {{userId}}, {{time}}, {{iden}}.'
    ),
    default:
      '{\n' +
      '    "event": {{event}},\n' +
      '    "iden": {{iden}},\n' +
      '    "callId": {{callId}},\n' +
      '    "direction": {{direction}},\n' +
      '    "owner": {{owner}},\n' +
      '    "party": {{party}},\n' +
      '    "userId": {{userId}},\n' +
      '    "time": {{time}}\n' +
      '}',
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
    'eventUpdateClid',
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
