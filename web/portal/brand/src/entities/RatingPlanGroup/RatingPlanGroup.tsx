import AccountTreeIcon from '@mui/icons-material/AccountTree';
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
  },
  description: {
    label: _('Description'),
    maxLength: 255,
  },
  currency: {
    label: _('Currency'),
    null: _('Default currency'),
  },
};

const RatingPlanGroup: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'RatingPlanGroup',
  title: _('RatingPlanGroup', { count: 2 }),
  path: '/RatingPlanGroups',
  toStr: (row: any) => row.id,
  properties,
  selectOptions,
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default RatingPlanGroup;
