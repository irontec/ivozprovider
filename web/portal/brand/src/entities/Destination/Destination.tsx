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
  prefix: {
    label: _('Prefix'),
    pattern: new RegExp('^\\+[0-9]+$'),
    default: '+',
    maxLength: 80,
    helpText: _(`Prefix must be '+' and numeric-only`),
  },
  name: {
    label: _('Name'),
    maxLength: 55,
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
  selectOptions,
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default Destination;
