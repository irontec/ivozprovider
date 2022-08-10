import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { NotificationTemplateProperties } from './NotificationTemplateProperties';
import foreignKeyResolver from './ForeignKeyResolver';

const properties: NotificationTemplateProperties = {
  name: {
    label: _('Name'),
    maxLength: 55,
  },
  type: {
    label: _('Type'),
    enum: {
      voicemail: _('Voicemail'),
      fax: _('Fax'),
      limit: _('Limit'),
      lowbalance: _('Low balance'),
      invoice: _('Invoice'),
      callCsv: _('Call CSV'),
      maxDailyUsage: _('Max daily usage'),
    },
  },
};

const NotificationTemplate: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'NotificationTemplate',
  title: _('NotificationTemplate', { count: 2 }),
  path: '/NotificationTemplates',
  toStr: (row: any) => row.id,
  properties,
  selectOptions,
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default NotificationTemplate;
