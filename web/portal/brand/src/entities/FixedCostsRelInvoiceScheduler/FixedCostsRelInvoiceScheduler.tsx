import AddCardIcon from '@mui/icons-material/AddCard';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { FixedCostsRelInvoiceSchedulerProperties } from './FixedCostsRelInvoiceSchedulerProperties';
import foreignKeyResolver from './ForeignKeyResolver';

const properties: FixedCostsRelInvoiceSchedulerProperties = {
  quantity: {
    label: _('Quantity'),
    default: 1,
    minimum: 1,
    maximum: 100,
  },
  quantityGhost: {
    title: _('Quantity'),
    //@TODO IvozProvider_Klear_Ghost_FixedCostsRelInvoiceSchedulers::getQuantity
  },
  type: {
    label: _('Type'),
    enum: {
      static: _('Static'),
      maxcalls: _('Max calls'),
      ddis: _('DDIs'),
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
    label: _('Country'),
    default: 70,
  },
  fixedCost: {
    label: _('Fixed cost'),
  },
  invoiceScheduler: {
    label: _('Invoice scheduler'),
  },
};

const FixedCostsRelInvoiceScheduler: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AddCardIcon,
  iden: 'FixedCostsRelInvoiceScheduler',
  title: _('Fixed cost', { count: 2 }),
  path: '/fixed_costs_rel_invoice_schedulers',
  toStr: (row: any) => row.id,
  properties,
  columns: ['fixedCost', 'type', 'quantity'],
  selectOptions,
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default FixedCostsRelInvoiceScheduler;
