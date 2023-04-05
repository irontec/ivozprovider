import RequestQuoteIcon from '@mui/icons-material/RequestQuote';
import EntityInterface, {
  ChildDecoratorType,
} from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior, {
  ChildDecorator as DefaultChildDecorator,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import {
  InvoiceTemplateProperties,
  InvoiceTemplatePropertyList,
} from './InvoiceTemplateProperties';
import { EntityValue, isEntityItem } from '@irontec/ivoz-ui';

const properties: InvoiceTemplateProperties = {
  description: {
    label: _('Description'),
  },
  name: {
    label: _('Name'),
  },
  template: {
    label: _('Template'),
    format: 'textarea',
  },
  templateHeader: {
    label: _('Template Header'),
    format: 'textarea',
  },
  templateFooter: {
    label: _('Template Footer'),
    format: 'textarea',
  },
};

export const ChildDecorator: ChildDecoratorType = (props) => {
  const { routeMapItem, row } = props;

  if (
    isEntityItem(routeMapItem) &&
    routeMapItem.entity.iden === InvoiceTemplate.iden
  ) {
    if (row.brand) {
      return null;
    }
  }

  return DefaultChildDecorator(props);
};

const InvoiceTemplate: EntityInterface = {
  ...defaultEntityBehavior,
  icon: RequestQuoteIcon,
  iden: 'InvoiceTemplate',
  title: _('Default Invoice template', { count: 2 }),
  path: '/invoice_templates',
  toStr: (row: InvoiceTemplatePropertyList<EntityValue>) => row.name as string,
  properties,
  columns: ['name', 'description'],
  selectOptions,
  Form,
};

export default InvoiceTemplate;
