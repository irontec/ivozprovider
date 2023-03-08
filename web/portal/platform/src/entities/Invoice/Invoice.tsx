import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { EntityValue } from '@irontec/ivoz-ui';
import { InvoiceProperties, InvoicePropertyList } from './InvoiceProperties';

const properties: InvoiceProperties = {};

const Invoice: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'Invoice',
  title: _('Invoice', { count: 2 }),
  path: '/invoices',
  toStr: (row: InvoicePropertyList<EntityValue>) => row.number as string,
  properties,
};

export default Invoice;
