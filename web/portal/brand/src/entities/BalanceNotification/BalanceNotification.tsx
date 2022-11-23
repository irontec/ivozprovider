import MoneyOffIcon from '@mui/icons-material/MoneyOff';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { BalanceNotificationProperties } from './BalanceNotificationProperties';
import foreignKeyResolver from './ForeignKeyResolver';

const properties: BalanceNotificationProperties = {
  toAddress: {
    label: _('To address'),
    maxLength: 255,
    helpText: _('Mail address where this notification will be sent'),
  },
  threshold: {
    label: _('Notification Threshold'),
    default: '0.0000',
    pattern: new RegExp('^[0-9]{1,6}[.]{0,1}[0-9]*$'),
    helpText: _(
      'Notification will be sent when the current balance is less that this value.'
    ),
    type: 'integer',
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
    label: _('Carrier'),
  },
  notificationTemplate: {
    label: _('Notification template'),
    null: _('Use generic template'),
  },
};

const BalanceNotification: EntityInterface = {
  ...defaultEntityBehavior,
  icon: MoneyOffIcon,
  iden: 'BalanceNotification',
  title: _('Balance Notification', { count: 2 }),
  path: '/balance_notifications',
  toStr: (row: any) => row.id,
  properties,
  columns: ['notificationTemplate', 'toAddress', 'threshold', 'lastSent'],
  selectOptions,
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default BalanceNotification;
