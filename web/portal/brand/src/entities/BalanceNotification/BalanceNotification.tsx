import { EntityValues } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import MoneyOffIcon from '@mui/icons-material/MoneyOff';

import {
  BalanceNotificationProperties,
  BalanceNotificationPropertyList,
} from './BalanceNotificationProperties';

const properties: BalanceNotificationProperties = {
  toAddress: {
    label: _('To address'),
    maxLength: 255,
    helpText: _('Mail address where this notification will be sent'),
    required: true,
  },
  threshold: {
    label: _('Notification Threshold'),
    default: '0.0000',
    pattern: new RegExp('^[0-9]{1,6}[.]{0,1}[0-9]*$'),
    helpText: _(
      'Notification will be sent when the current balance is less that this value.'
    ),
    type: 'integer',
    required: true,
  },
  lastSent: {
    label: _('Last notification sent on'),
    readOnly: true,
    format: 'date-time',
  },
  company: {
    label: _('Client'),
  },
  carrier: {
    label: _('Carrier', { count: 1 }),
  },
  notificationTemplate: {
    label: _('Notification template', { count: 1 }),
    null: _('Use generic template'),
    default: '__null__',
  },
};

const BalanceNotification: EntityInterface = {
  ...defaultEntityBehavior,
  icon: MoneyOffIcon,
  iden: 'BalanceNotification',
  title: _('Balance Notification', { count: 2 }),
  path: '/balance_notifications',
  toStr: (row: BalanceNotificationPropertyList<EntityValues>) => `${row.id}`,
  properties,
  columns: ['notificationTemplate', 'toAddress', 'threshold', 'lastSent'],
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
  foreignKeyResolver: async () => {
    const module = await import('./ForeignKeyResolver');

    return module.default;
  },
  foreignKeyGetter: async () => {
    const module = await import('./ForeignKeyGetter');

    return module.foreignKeyGetter;
  },
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
};

export default BalanceNotification;
