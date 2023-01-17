import FlagIcon from '@mui/icons-material/Flag';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { RoutingPatternProperties } from './RoutingPatternProperties';
import foreignKeyResolver from './ForeignKeyResolver';

const properties: RoutingPatternProperties = {
  prefix: {
    label: _('Prefix'),
    pattern: new RegExp('/+[0-9]*/'),
    maxLength: 80,
    helpText: _(`Must start with '+' followed by zero or more digits.`),
  },
  name: {
    label: _('Name'),
    maxLength: 55,
    multilang: true,
  },
  description: {
    label: _('Description'),
    maxLength: 55,
    multilang: true,
  },
};

const RoutingPattern: EntityInterface = {
  ...defaultEntityBehavior,
  icon: FlagIcon,
  iden: 'RoutingPattern',
  title: _('Routing Pattern', { count: 2 }),
  path: '/routing_patterns',
  toStr: (row: any) => row.name.en,
  properties,
  columns: ['name', 'description', 'prefix'],
  selectOptions,
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default RoutingPattern;
