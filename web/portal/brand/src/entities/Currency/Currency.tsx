import { EntityValues } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import AccountTreeIcon from '@mui/icons-material/AccountTree';

import { CurrencyProperties, CurrencyPropertyList } from './CurrencyProperties';

const properties: CurrencyProperties = {
  iden: {
    label: _('Iden'),
  },
  symbol: {
    label: _('Symbol'),
  },
  id: {
    label: _('Id'),
  },
  name: {
    label: _('Name'),
  },
};

const Currency: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'Currency',
  title: _('Currency', { count: 2 }),
  path: '/currencies',
  toStr: (row: CurrencyPropertyList<EntityValues>) =>
    `${row.name?.en} (${row.symbol})`,
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

export default Currency;
