import { EntityValues } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import FlagIcon from '@mui/icons-material/Flag';

import {
  RoutingPatternProperties,
  RoutingPatternPropertyList,
} from './RoutingPatternProperties';

const properties: RoutingPatternProperties = {
  prefix: {
    label: _('Prefix'),
    pattern: new RegExp(/\+[0-9]*/),
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
  toStr: (row: RoutingPatternPropertyList<EntityValues>) => `${row.name?.en}`,
  properties,
  columns: ['name', 'description', 'prefix'],
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

export default RoutingPattern;
