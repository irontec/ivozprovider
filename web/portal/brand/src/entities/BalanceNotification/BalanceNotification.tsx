import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { BalanceNotificationProperties } from './BalanceNotificationProperties';
import foreignKeyResolver from './ForeignKeyResolver';

const properties: BalanceNotificationProperties = {
  'toAddress': {
    label: _('To Address'),
  },
  'threshold': {
    label: _('Threshold'),
  },
  'lastSent': {
    label: _('Last Sent'),
  },
  'id': {
    label: _('Id'),
  },
  'company': {
    label: _('Company'),
  },
  'notificationTemplate': {
    label: _('Notification Template'),
  },
};

const BalanceNotification: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'BalanceNotification',
  title: _('BalanceNotification', { count: 2 }),
  path: '/BalanceNotifications',
  toStr: (row: any) => row.id,
  properties,
  selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default BalanceNotification;