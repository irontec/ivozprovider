import FlagCircleIcon from '@mui/icons-material/FlagCircle';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { RoutingPatternGroupProperties } from './RoutingPatternGroupProperties';
import foreignKeyResolver from './ForeignKeyResolver';

const properties: RoutingPatternGroupProperties = {
  name: {
    label: _('Name'),
    maxLength: 55,
    required: true,
  },
  description: {
    label: _('Description'),
    maxLength: 55,
  },
  patternIds: {
    label: _('Routing pattern', { count: 2 }),
    type: 'array',
    $ref: '#/definitions/RoutingPattern',
  },
};

const RoutingPatternGroup: EntityInterface = {
  ...defaultEntityBehavior,
  icon: FlagCircleIcon,
  iden: 'RoutingPatternGroup',
  title: _('Routing pattern group', { count: 2 }),
  path: '/routing_pattern_groups',
  toStr: (row: any) => row.name,
  properties,
  columns: ['name', 'description', 'patternIds'],
  selectOptions,
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default RoutingPatternGroup;
