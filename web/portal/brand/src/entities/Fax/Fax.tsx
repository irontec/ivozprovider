import { EntityValues } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import AccountTreeIcon from '@mui/icons-material/AccountTree';

import { FaxProperties, FaxPropertyList } from './FaxProperties';

const properties: FaxProperties = {
  name: {
    label: _('Name'),
  },
  email: {
    label: _('Email'),
  },
  sendByEmail: {
    label: _('Send By Email'),
  },
  id: {
    label: _('Id'),
  },
  company: {
    label: _('Company', { count: 1 }),
  },
  outgoingDdi: {
    label: _('Outgoing DDI'),
  },
};

const Fax: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'Fax',
  title: _('Fax', { count: 2 }),
  path: '/faxes',
  toStr: (row: FaxPropertyList<EntityValues>) => `${row.name}`,
  properties,
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

export default Fax;
