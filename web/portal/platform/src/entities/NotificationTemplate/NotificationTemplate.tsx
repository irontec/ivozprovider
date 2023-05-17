import { EntityValue } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import MailOutlineIcon from '@mui/icons-material/MailOutline';

import {
  NotificationTemplateProperties,
  NotificationTemplatePropertyList,
} from './NotificationTemplateProperties';

const properties: NotificationTemplateProperties = {
  name: {
    label: _('Name'),
  },
  type: {
    label: _('Type'),
    enum: {
      voicemail: _('Voicemail'),
      fax: _('Fax'),
      limit: _('Limit'),
      lowbalance: _('Lowbalance'),
      invoice: _('Invoice'),
      callCsv: _('Call Csv'),
      maxDailyUsage: _('Max DailyUsage'),
    },
  },
  id: {
    label: _('Id'),
  },
  brand: {
    label: _('Brand'),
  },
};

const NotificationTemplate: EntityInterface = {
  ...defaultEntityBehavior,
  acl: {
    ...defaultEntityBehavior.acl,
    detail: false,
  },
  icon: MailOutlineIcon,
  iden: 'NotificationTemplate',
  title: _('Default Notification template', { count: 2 }),
  path: '/notification_templates',
  columns: ['name', 'type'],
  toStr: (row: NotificationTemplatePropertyList<EntityValue>) =>
    row.name as string,
  properties,
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
};

export default NotificationTemplate;
