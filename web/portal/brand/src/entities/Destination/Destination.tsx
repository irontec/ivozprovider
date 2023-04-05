import LanguageIcon from '@mui/icons-material/Language';
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
    multilang: true,
  },
};

const Destination: EntityInterface = {
  ...defaultEntityBehavior,
  icon: LanguageIcon,
  iden: 'Destination',
  title: _('Destination', { count: 2 }),
  path: '/destinations',
  toStr: (row: any) => row.name.en,
  properties,
  columns: ['name', 'prefix'],
  selectOptions,
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default Destination;
