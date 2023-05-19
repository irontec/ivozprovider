import { EntityValues } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import AddCardIcon from '@mui/icons-material/AddCard';

import {
  FixedCostProperties,
  FixedCostPropertyList,
} from './FixedCostProperties';

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
  toStr: (row: FixedCostPropertyList<EntityValues>) =>
    `${row.name} - ${row.cost}`,
  properties,
  columns: ['name', 'cost', 'description'],
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

export default FixedCost;
