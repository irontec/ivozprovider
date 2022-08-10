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
  name: {
    label: _('Name'),
    maxLength: 55,
  },
  description: {
    label: _('Description'),
    maxLength: 300,
  },
  template: {
    label: _('Template'),
    format: 'textarea',
    //@TODO massive helpText
    //@TODO codemirror
  },
  templateHeader: {
    label: _('Template Header'),
    format: 'textarea',
    //@TODO massive helpText
    //@TODO codemirror
  },
  templateFooter: {
    label: _('Template Footer'),
    format: 'textarea',
    //@TODO massive helpText
    //@TODO codemirror
  },
  global: {
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
  selectOptions,
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default InvoiceTemplate;
