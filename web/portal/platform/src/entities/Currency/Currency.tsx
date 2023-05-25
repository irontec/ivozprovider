import { EntityValues } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import AccountTreeIcon from '@mui/icons-material/AccountTree';
import { getI18n } from 'react-i18next';

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
    multilang: true,
  },
};

const Currency: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'Currency',
  title: _('Currency', { count: 2 }),
  path: '/currencies',
  columns: ['iden', 'name', 'symbol'],
  toStr: (row: CurrencyPropertyList<EntityValues>) => {
    const language = getI18n().language.substring(0, 2);
    const name = row.name as Record<string, string>;

    return `${name[language]} (${row.symbol})`;
  },
  properties,
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
};

export default Currency;
