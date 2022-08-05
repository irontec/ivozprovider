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
  'name': {
    label: _('Name'),
  },
  'type': {
    label: _('Type'),
    enum: {
      'voicemail' : _('Voicemail'),
      'fax' : _('Fax'),
      'limit' : _('Limit'),
      'lowbalance' : _('Lowbalance'),
      'invoice' : _('Invoice'),
      'callCsv' : _('Call Csv'),
      'maxDailyUsage' : _('Max DailyUsage'),
    },
  },
  'id': {
    label: _('Id'),
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
  selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default NotificationTemplate;