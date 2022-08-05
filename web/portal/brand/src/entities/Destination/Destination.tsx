import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { DestinationProperties } from './DestinationProperties';
import foreignKeyResolver from './ForeignKeyResolver';

const properties: DestinationProperties = {
  'prefix': {
    label: _('Prefix'),
  },
  'id': {
    label: _('Id'),
  },
  'name': {
    label: _('Name'),
  },
};

const Destination: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'Destination',
  title: _('Destination', { count: 2 }),
  path: '/Destinations',
  toStr: (row: any) => row.id,
  properties,
  selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default Destination;