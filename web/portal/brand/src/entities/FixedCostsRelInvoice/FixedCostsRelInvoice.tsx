import AccountTreeIcon from '@mui/icons-material/AccountTree';
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
  icon: AccountTreeIcon,
  iden: 'FixedCostsRelInvoice',
  title: _('FixedCostsRelInvoice', { count: 2 }),
  path: '/FixedCostsRelInvoices',
  toStr: (row: any) => row.id,
  properties,
  selectOptions,
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default FixedCostsRelInvoice;
