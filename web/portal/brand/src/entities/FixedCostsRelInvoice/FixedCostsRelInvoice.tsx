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
  'quantity': {
    label: _('Quantity'),
  },
  'id': {
    label: _('Id'),
  },
  'fixedCost': {
    label: _('Fixed Cost'),
  },
  'invoice': {
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
  selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default FixedCostsRelInvoice;