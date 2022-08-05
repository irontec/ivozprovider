import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { NotificationTemplateContentProperties } from './NotificationTemplateContentProperties';
import foreignKeyResolver from './ForeignKeyResolver';

const properties: NotificationTemplateContentProperties = {
  'fromName': {
    label: _('From Name'),
  },
  'fromAddress': {
    label: _('From Address'),
  },
  'subject': {
    label: _('Subject'),
  },
  'body': {
    label: _('Body'),
  },
  'bodyType': {
    label: _('Body Type'),
    enum: {
      'text/plain' : _('Text /plain'),
      'text/html' : _('Text /html'),
    },
  },
  'id': {
    label: _('Id'),
  },
  'notificationTemplate': {
    label: _('Notification Template'),
  },
  'language': {
    label: _('Language'),
  },
};

const NotificationTemplateContent: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'NotificationTemplateContent',
  title: _('NotificationTemplateContent', { count: 2 }),
  path: '/NotificationTemplateContents',
  toStr: (row: any) => row.id,
  properties,
  selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default NotificationTemplateContent;