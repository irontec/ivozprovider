import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { RatingProfileProperties } from './RatingProfileProperties';
import foreignKeyResolver from './ForeignKeyResolver';

const properties: RatingProfileProperties = {
  'activationTime': {
    label: _('Activation Time'),
  },
  'id': {
    label: _('Id'),
  },
  'company': {
    label: _('Company'),
  },
  'carrier': {
    label: _('Carrier'),
  },
  'ratingPlanGroup': {
    label: _('Rating PlanGroup'),
  },
  'routingTag': {
    label: _('Routing Tag'),
  },
};

const RatingProfile: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'RatingProfile',
  title: _('RatingProfile', { count: 2 }),
  path: '/RatingProfiles',
  toStr: (row: any) => row.id,
  properties,
  selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default RatingProfile;