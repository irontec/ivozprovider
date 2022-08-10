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
  activationTime: {
    label: _('Activation time'),
    format: 'date-time',
  },
  company: {
    label: _('Client'),
    null: _('Unassigned'),
  },
  carrier: {
    label: _('Carrier'),
  },
  ratingPlanGroup: {
    label: _('Rating plan'),
  },
  routingTag: {
    label: _('Routing Tag'),
    null: _('No routing tag'),
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
  selectOptions,
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default RatingProfile;
