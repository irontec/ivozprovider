import { EntityValues } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import FlagCircleIcon from '@mui/icons-material/FlagCircle';

import {
  RoutingPatternGroupProperties,
  RoutingPatternGroupPropertyList,
} from './RoutingPatternGroupProperties';

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
  toStr: (row: RoutingPatternGroupPropertyList<EntityValues>) => `${row.name}`,
  properties,
  columns: ['name', 'description', 'patternIds'],
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
  foreignKeyResolver: async () => {
    const module = await import('./ForeignKeyResolver');

    return module.default;
  },
  foreignKeyGetter: async () => {
    const module = await import('./ForeignKeyGetter');

    return module.foreignKeyGetter;
  },
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
};

export default RoutingPatternGroup;
