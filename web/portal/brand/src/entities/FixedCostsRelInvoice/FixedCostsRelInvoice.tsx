import AddCardIcon from '@mui/icons-material/AddCard';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { FixedCostsRelInvoiceProperties } from './FixedCostsRelInvoiceProperties';
import foreignKeyResolver from './ForeignKeyResolver';

const properties: FixedCostsRelInvoiceProperties = {
  quantity: {
    label: _('Quantity'),
    default: 1,
    minimum: 1,
    maximum: 100,
  },
  fixedCost: {
    label: _('Fixed cost'),
  },
  invoice: {
    label: _('Invoice'),
  },
};

const FixedCostsRelInvoice: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AddCardIcon,
  iden: 'FixedCostsRelInvoice',
  title: _('FixedCostsRelInvoice', { count: 2 }),
  path: '/fixed_costs_rel_invoices',
  toStr: (row: any) => row.id,
  properties,
  columns: ['fixedCost', 'quantity'],
  selectOptions,
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default FixedCostsRelInvoice;
