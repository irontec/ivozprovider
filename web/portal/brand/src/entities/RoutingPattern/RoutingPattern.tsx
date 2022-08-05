import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { RoutingPatternProperties } from './RoutingPatternProperties';
import foreignKeyResolver from './ForeignKeyResolver';

const properties: RoutingPatternProperties = {
  'prefix': {
    label: _('Prefix'),
  },
  'id': {
    label: _('Id'),
  },
  'name': {
    label: _('Name'),
  },
  'description': {
    label: _('Description'),
  },
};

const RoutingPattern: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'RoutingPattern',
  title: _('RoutingPattern', { count: 2 }),
  path: '/RoutingPatterns',
  toStr: (row: any) => row.id,
  properties,
  selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default RoutingPattern;