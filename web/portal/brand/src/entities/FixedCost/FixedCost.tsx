import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { FixedCostProperties } from './FixedCostProperties';
import foreignKeyResolver from './ForeignKeyResolver';

const properties: FixedCostProperties = {
  name: {
    label: _('Name'),
    maxLength: 255,
  },
  description: {
    label: _('Description'),
    format: 'textarea',
  },
  cost: {
    label: _('Cost'),
    pattern: new RegExp('^[0-9]{1,6}([.][0-9]{1,4})?$'),
  },
};

const FixedCost: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'FixedCost',
  title: _('FixedCost', { count: 2 }),
  path: '/FixedCosts',
  toStr: (row: any) => row.id,
  properties,
  selectOptions,
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default FixedCost;
