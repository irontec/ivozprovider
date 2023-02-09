import SubjectIcon from '@mui/icons-material/Subject';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import Form from './Form';
import {
  NotificationTemplateContentProperties,
  NotificationTemplateContentPropertyList,
} from './NotificationTemplateContentProperties';
import { EntityValue } from '@irontec/ivoz-ui';
import selectOptions from './SelectOptions';

const properties: NotificationTemplateContentProperties = {
  fromName: {
    label: _('From Name'),
  },
  fromAddress: {
    label: _('From Address'),
  },
  subject: {
    label: _('Subject'),
  },
  body: {
    label: _('Body'),
    format: 'textarea',
  },
  bodyType: {
    label: _('Body Type'),
    enum: {
      'text/plain': _('Text /plain'),
      'text/html': _('Text /html'),
    },
  },
  id: {
    label: _('Id'),
  },
  notificationTemplate: {
    label: _('Notification Template'),
  },
  language: {
    label: _('Language'),
    multilang: true,
  },
};

const NotificationTemplateContent: EntityInterface = {
  ...defaultEntityBehavior,
  icon: SubjectIcon,
  iden: 'NotificationTemplateContent',
  title: _('NotificationTemplateContent', { count: 2 }),
  path: '/notification_template_contents',
  toStr: (row: NotificationTemplateContentPropertyList<EntityValue>) =>
    row.fromName as string,
  properties,
  columns: ['language', 'fromName', 'fromAddress'],
  selectOptions,
  Form,
};

export default NotificationTemplateContent;
