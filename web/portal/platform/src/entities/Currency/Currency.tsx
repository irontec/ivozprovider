import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import Form from './Form';
import { CurrencyProperties, CurrencyPropertyList } from './CurrencyProperties';
import { EntityValue } from '@irontec/ivoz-ui';

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
  columns: ['iden', 'symbol', 'name'],
  toStr: (row: CurrencyPropertyList<EntityValue>) => row.name as string,
  properties,

  Form,
};

export default Currency;
