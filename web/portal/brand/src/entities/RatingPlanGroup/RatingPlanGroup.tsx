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
  'id': {
    label: _('Id'),
  },
  'name': {
    label: _('Name'),
  },
  'description': {
    label: _('Description'),
  },
  'currency': {
    label: _('Currency'),
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
  selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default RatingPlanGroup;