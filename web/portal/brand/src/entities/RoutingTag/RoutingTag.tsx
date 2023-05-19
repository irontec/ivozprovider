import { EntityValues } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import BookmarkIcon from '@mui/icons-material/Bookmark';

import {
  RoutingTagProperties,
  RoutingTagPropertyList,
} from './RoutingTagProperties';

const properties: RoutingTagProperties = {
  name: {
    label: _('Name'),
    maxLength: 80,
  },
  tag: {
    label: _('Tag'),
    pattern: new RegExp(`^[0-9]{1,3}#$`),
    maxLength: 15,
    helpText: _(`From 1 to 3 digits ended by # symbol`),
  },
};

const RoutingTag: EntityInterface = {
  ...defaultEntityBehavior,
  icon: BookmarkIcon,
  iden: 'RoutingTag',
  title: _('Routing Tag', { count: 2 }),
  path: '/routing_tags',
  toStr: (row: RoutingTagPropertyList<EntityValues>) =>
    `${row.name} (${row.tag})`,
  properties,
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

export default RoutingTag;
