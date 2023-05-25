import { EntityValues } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import AddCardIcon from '@mui/icons-material/AddCard';

import {
  FixedCostsRelInvoiceSchedulerProperties,
  FixedCostsRelInvoiceSchedulerPropertyList,
} from './FixedCostsRelInvoiceSchedulerProperties';

const properties: FixedCostsRelInvoiceSchedulerProperties = {
  quantity: {
    label: _('Quantity'),
    default: 1,
    minimum: 1,
    maximum: 100,
  },
  quantityGhost: {
    label: _('Quantity'),
    //@TODO IvozProvider_Klear_Ghost_FixedCostsRelInvoiceSchedulers::getQuantity
  },
  type: {
    label: _('Type'),
    enum: {
      static: _('Static'),
      maxcalls: _('Max calls'),
      ddis: _('DDI', { count: 2 }),
    },
    visualToggle: {
      static: {
        show: ['quantity'],
        hide: ['ddisCountry', 'ddisCountryMatch'],
      },
      maxcalls: {
        show: [],
        hide: ['quantity', 'ddisCountryMatch', 'ddisCountry'],
      },
      ddis: {
        show: ['ddisCountryMatch'],
        hide: ['quantity'],
      },
    },
  },
  ddisCountryMatch: {
    label: _('DDIs Match mode'),
    enum: {
      all: _('All'),
      national: _('National'),
      international: _('International'),
      specific: _('Specific'),
    },
    visualToggle: {
      all: {
        show: [],
        hide: ['ddisCountry'],
      },
      national: {
        show: [],
        hide: ['ddisCountry'],
      },
      international: {
        show: [],
        hide: ['ddisCountry'],
      },
      specific: {
        show: ['ddisCountry'],
        hide: [],
      },
    },
  },
  ddisCountry: {
    label: _('Country', { count: 1 }),
    default: 70,
  },
  fixedCost: {
    label: _('Fixed cost', { count: 1 }),
  },
  invoiceScheduler: {
    label: _('Invoice Scheduler', { count: 1 }),
  },
};

const FixedCostsRelInvoiceScheduler: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AddCardIcon,
  iden: 'FixedCostsRelInvoiceScheduler',
  title: _('Fixed cost', { count: 2 }),
  path: '/fixed_costs_rel_invoice_schedulers',
  toStr: (row: FixedCostsRelInvoiceSchedulerPropertyList<EntityValues>) =>
    `${row.id}`,
  properties,
  columns: ['fixedCost', 'type', 'quantity'],
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

export default FixedCostsRelInvoiceScheduler;
