import AddCardIcon from '@mui/icons-material/AddCard';
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
    required: true,
  },
};

const FixedCost: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AddCardIcon,
  iden: 'FixedCost',
  title: _('Fixed cost', { count: 2 }),
  path: '/fixed_costs',
  toStr: (row: any) => `${row.name} - ${row.cost}`,
  properties,
  columns: ['name', 'cost', 'description'],
  selectOptions,
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default FixedCost;
