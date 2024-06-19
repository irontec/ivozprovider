import { EntityValue } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import AccountTreeIcon from '@mui/icons-material/AccountTree';

import { InvoiceProperties, InvoicePropertyList } from './InvoiceProperties';

const properties: InvoiceProperties = {};

const Invoice: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  link: '/doc/en/administration_portal/brand/invoicing/invoices.html',
  iden: 'Invoice',
  title: _('Invoice', { count: 2 }),
  path: '/invoices',
  toStr: (row: InvoicePropertyList<EntityValue>) => row.number as string,
  properties,
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'Invoices',
  },
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
};

export default Invoice;
