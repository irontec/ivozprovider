import AttachMoneyIcon from '@mui/icons-material/AttachMoney';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { RatingPlanGroupProperties } from './RatingPlanGroupProperties';
import foreignKeyResolver from './ForeignKeyResolver';

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
    label: _('Currency'),
    null: _('Default currency'),
  },
};

const RatingPlanGroup: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AttachMoneyIcon,
  iden: 'RatingPlanGroup',
  title: _('Rating Plan Group', { count: 2 }),
  path: '/rating_plan_groups',
  toStr: (row: any) => row.name.en,
  properties,
  selectOptions,
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default RatingPlanGroup;
