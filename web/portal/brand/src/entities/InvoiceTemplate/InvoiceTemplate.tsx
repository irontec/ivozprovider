import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { InvoiceTemplateProperties } from './InvoiceTemplateProperties';
import foreignKeyResolver from './ForeignKeyResolver';

const properties: InvoiceTemplateProperties = {
  'name': {
    label: _('Name'),
  },
  'description': {
    label: _('Description'),
  },
  'template': {
    label: _('Template'),
  },
  'templateHeader': {
    label: _('Template Header'),
  },
  'templateFooter': {
    label: _('Template Footer'),
  },
  'id': {
    label: _('Id'),
  },
  'global': {
    label: _('Global'),
  },
};

const InvoiceTemplate: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'InvoiceTemplate',
  title: _('InvoiceTemplate', { count: 2 }),
  path: '/InvoiceTemplates',
  toStr: (row: any) => row.id,
  properties,
  selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default InvoiceTemplate;