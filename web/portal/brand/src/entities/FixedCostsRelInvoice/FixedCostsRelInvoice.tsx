import { EntityValues } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import AddCardIcon from '@mui/icons-material/AddCard';

import {
  FixedCostsRelInvoiceProperties,
  FixedCostsRelInvoicePropertyList,
} from './FixedCostsRelInvoiceProperties';

const properties: FixedCostsRelInvoiceProperties = {
  quantity: {
    label: _('Quantity'),
    default: 1,
    minimum: 1,
    maximum: 100,
  },
  fixedCost: {
    label: _('Fixed cost', { count: 1 }),
  },
  invoice: {
    label: _('Invoice', { count: 1 }),
  },
};

const FixedCostsRelInvoice: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AddCardIcon,
  iden: 'FixedCostsRelInvoice',
  title: _('FixedCostsRelInvoice', { count: 2 }),
  path: '/fixed_costs_rel_invoices',
  toStr: (row: FixedCostsRelInvoicePropertyList<EntityValues>) => `${row.id}`,
  properties,
  columns: ['fixedCost', 'quantity'],
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

export default FixedCostsRelInvoice;
