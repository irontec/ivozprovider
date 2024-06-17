import { EntityValues } from '@irontec-voip/ivoz-ui';
import defaultEntityBehavior from '@irontec-voip/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec-voip/ivoz-ui/entities/EntityInterface';
import _ from '@irontec-voip/ivoz-ui/services/translations/translate';
import FormatListNumberedIcon from '@mui/icons-material/FormatListNumbered';

import {
  MatchListProperties,
  MatchListPropertyList,
} from './MatchListProperties';

const properties: MatchListProperties = {
  name: {
    label: _('Name'),
  },
  id: {
    label: _('Id'),
  },
};

const MatchList: EntityInterface = {
  ...defaultEntityBehavior,
  icon: FormatListNumberedIcon,
  link: '/doc/en/administration_portal/brand/settings/generic_match_lists.html',
  iden: 'MatchList',
  title: _('Generic Match List', { count: 2 }),
  path: '/match_lists',
  toStr: (row: MatchListPropertyList<EntityValues>) => `${row.name}`,
  properties,
  defaultOrderBy: '',
  columns: ['name'],
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'MatchLists',
  },
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

export default MatchList;
