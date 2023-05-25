import { EntityValues } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import AttachMoneyIcon from '@mui/icons-material/AttachMoney';

import {
  RatingPlanGroupProperties,
  RatingPlanGroupPropertyList,
} from './RatingPlanGroupProperties';

const properties: RatingPlanGroupProperties = {
  name: {
    label: _('Name'),
    maxLength: 55,
    multilang: true,
  },
  description: {
    label: _('Description'),
    maxLength: 255,
    multilang: true,
  },
  currency: {
    label: _('Currency', { count: 1 }),
    null: _('Default currency'),
  },
};

const RatingPlanGroup: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AttachMoneyIcon,
  iden: 'RatingPlanGroup',
  title: _('Rating Plan Group', { count: 2 }),
  path: '/rating_plan_groups',
  toStr: (row: RatingPlanGroupPropertyList<EntityValues>) => `${row.name?.en}`,
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

export default RatingPlanGroup;
