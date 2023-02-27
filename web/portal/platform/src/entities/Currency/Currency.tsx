import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import Form from './Form';
import { CurrencyProperties, CurrencyPropertyList } from './CurrencyProperties';
import { EntityValues } from '@irontec/ivoz-ui';
import { getI18n } from 'react-i18next';
import selectOptions from './SelectOptions';

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
  selectOptions,
  Form,
};

export default Currency;
