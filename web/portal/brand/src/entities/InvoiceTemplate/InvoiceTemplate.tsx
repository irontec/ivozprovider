import { EntityValues, isEntityItem } from '@irontec/ivoz-ui';
import DeleteRowButton from '@irontec/ivoz-ui/components/List/Content/CTA/DeleteRowButton';
import EditRowButton from '@irontec/ivoz-ui/components/List/Content/CTA/EditRowButton';
import defaultEntityBehavior, {
  ChildDecorator as DefaultChildDecorator,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface, {
  ChildDecoratorType,
} from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import ReceiptLongIcon from '@mui/icons-material/ReceiptLong';

import Actions from './Action';
import {
  InvoiceTemplateProperties,
  InvoiceTemplatePropertyList,
} from './InvoiceTemplateProperties';

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

export const ChildDecorator: ChildDecoratorType = (props) => {
  const { routeMapItem, row, entityService } = props;

  if (
    isEntityItem(routeMapItem) &&
    routeMapItem.entity.iden === InvoiceTemplate.iden
  ) {
    if (!row.global) {
      return DefaultChildDecorator(props);
    }

    const isDeletePath = routeMapItem.route === `${InvoiceTemplate.path}/:id`;
    const isUpdatePath =
      routeMapItem.route === `${InvoiceTemplate.path}/:id/update`;

    if (isDeletePath) {
      return (
        <DeleteRowButton
          disabled={true}
          row={row}
          entityService={entityService}
        />
      );
    }

    if (isUpdatePath) {
      return <EditRowButton disabled={true} row={row} path={''} />;
    }
  }

  return DefaultChildDecorator(props);
};

const InvoiceTemplate: EntityInterface = {
  ...defaultEntityBehavior,
  icon: ReceiptLongIcon,
  link: '/doc/en/administration_portal/brand/invoicing/invoice_templates.html',
  iden: 'InvoiceTemplate',
  title: _('Invoice template', { count: 2 }),
  path: '/invoice_templates',
  toStr: (row: InvoiceTemplatePropertyList<EntityValues>) => `${row.name}`,
  properties,
  columns: ['name', 'description'],
  customActions: Actions,
  defaultOrderBy: '',
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'InvoiceTemplates',
  },
  ChildDecorator,
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

export default InvoiceTemplate;
