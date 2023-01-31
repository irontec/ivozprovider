import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import DraftsIcon from '@mui/icons-material/Drafts';
import {
  NotificationTemplateProperties,
  NotificationTemplatePropertyList,
} from './NotificationTemplateProperties';
import selectOptions from './SelectOptions';
import { EntityValue } from '@irontec/ivoz-ui';

const properties: NotificationTemplateProperties = {
  name: {
    label: _('Name'),
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
  toStr: (row: NotificationTemplatePropertyList<EntityValue>) =>
    row.name as string,
  properties,
  selectOptions,
};

export default NotificationTemplate;
