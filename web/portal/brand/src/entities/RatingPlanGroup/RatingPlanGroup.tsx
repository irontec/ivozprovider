import { EntityValues } from '@irontec-voip/ivoz-ui';
import defaultEntityBehavior from '@irontec-voip/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec-voip/ivoz-ui/entities/EntityInterface';
import _ from '@irontec-voip/ivoz-ui/services/translations/translate';
import AttachMoneyIcon from '@mui/icons-material/AttachMoney';
import { getI18n } from 'react-i18next';

import Actions from './Action';
import {
  RatingPlanGroupProperties,
  RatingPlanGroupPropertyList,
} from './RatingPlanGroupProperties';

const properties: RatingPlanGroupProperties = {
  name: {
    label: _('Name'),
    maxLength: 55,
    multilang: true,
    required: true,
  },
  description: {
    label: _('Description'),
    maxLength: 255,
    multilang: true,
    required: false,
  },
  currency: {
    label: _('Currency', { count: 1 }),
    null: _('Default currency'),
    default: '__null__',
  },
};

const RatingPlanGroup: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AttachMoneyIcon,
  link: '/doc/en/administration_portal/brand/billing/rating_plans.html',
  iden: 'RatingPlanGroup',
  title: _('Rating Plan Group', { count: 2 }),
  path: '/rating_plan_groups',
  toStr: (row: RatingPlanGroupPropertyList<EntityValues>) => {
    const language = getI18n().language.substring(0, 2);

    return `${row.name?.[language]}`;
  },
  properties,
  defaultOrderBy: '',
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'RatingPlanGroups',
  },
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
  customActions: Actions,
};

export default RatingPlanGroup;
