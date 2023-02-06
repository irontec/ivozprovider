import RequestQuoteIcon from '@mui/icons-material/RequestQuote';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import {
  InvoiceTemplateProperties,
  InvoiceTemplatePropertyList,
} from './InvoiceTemplateProperties';
import { EntityValue } from '@irontec/ivoz-ui';

const properties: InvoiceTemplateProperties = {
  description: {
    label: _('Description'),
  },
  name: {
    label: _('Name'),
  },
};

const InvoiceTemplate: EntityInterface = {
  ...defaultEntityBehavior,
  icon: RequestQuoteIcon,
  iden: 'InvoiceTemplate',
  title: _('Invoice Template', { count: 2 }),
  path: '/invoice_templates',
  toStr: (row: InvoiceTemplatePropertyList<EntityValue>) => row.name as string,
  properties,
  columns: ['name', 'description'],
  selectOptions,
  Form,
};

export default InvoiceTemplate;
