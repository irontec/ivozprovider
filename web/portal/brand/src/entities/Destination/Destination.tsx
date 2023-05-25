import { EntityValues } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import LanguageIcon from '@mui/icons-material/Language';

import {
  DestinationProperties,
  DestinationPropertyList,
} from './DestinationProperties';

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
  toStr: (row: DestinationPropertyList<EntityValues>) => `${row.name?.en}`,
  properties,
  columns: ['name', 'prefix'],
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

export default Destination;
