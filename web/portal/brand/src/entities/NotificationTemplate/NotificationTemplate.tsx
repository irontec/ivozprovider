import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import DraftsIcon from '@mui/icons-material/Drafts';
import { foreignKeyGetter } from './ForeignKeyGetter';
import foreignKeyResolver from './ForeignKeyResolver';
import Form from './Form';
import { NotificationTemplateProperties } from './NotificationTemplateProperties';
import selectOptions from './SelectOptions';

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
  toStr: (row: any) => row.name,
  properties,
  selectOptions,
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default NotificationTemplate;
