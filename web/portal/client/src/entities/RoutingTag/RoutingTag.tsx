import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import { PartialPropertyList } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import SettingsApplications from '@mui/icons-material/SettingsApplications';

import { RoutingTagPropertyList } from './RoutingTagProperties';

const properties: PartialPropertyList = {
  name: {
    label: _('Name'),
  },
  tag: {
    label: _('Tag'),
  },
};

const columns = ['name', 'tag'];

const routingTag: EntityInterface = {
  ...defaultEntityBehavior,
  icon: SettingsApplications,
  iden: 'RoutingTag',
  title: _('Routing tag', { count: 2 }),
  path: '/routing_tags',
  toStr: (row: RoutingTagPropertyList<string>) => {
    return `${row.name} (${row.tag})`;
  },
  properties,
  columns,
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'RoutingTags',
  },
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
};

export default routingTag;
