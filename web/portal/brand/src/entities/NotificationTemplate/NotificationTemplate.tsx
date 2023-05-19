import { EntityValues } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import DraftsIcon from '@mui/icons-material/Drafts';

import {
  NotificationTemplateProperties,
  NotificationTemplatePropertyList,
} from './NotificationTemplateProperties';

const properties: NotificationTemplateProperties = {
  name: {
    label: _('Name'),
    maxLength: 55,
  },
  type: {
    label: _('Type'),
    enum: {
      voicemail: _('Voicemail'),
      fax: _('Fax', { count: 1 }),
      lowbalance: _('Low balance'),
      invoice: _('Invoice', { count: 1 }),
      callCsv: _('Call CSV'),
      maxDailyUsage: _('Max daily usage'),
    },
  },
};

const NotificationTemplate: EntityInterface = {
  ...defaultEntityBehavior,
  icon: DraftsIcon,
  iden: 'NotificationTemplate',
  title: _('Notification template', { count: 2 }),
  path: '/notification_templates',
  toStr: (row: NotificationTemplatePropertyList<EntityValues>) => `${row.name}`,
  properties,
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

export default NotificationTemplate;
