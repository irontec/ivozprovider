import { EntityValue } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import AccountTreeIcon from '@mui/icons-material/AccountTree';

import {
  MediaRelaySetProperties,
  MediaRelaySetPropertyList,
} from './MediaRelaySetProperties';

const properties: MediaRelaySetProperties = {
  name: {
    label: _('Name'),
  },
  description: {
    label: _('Description'),
  },
  id: {
    label: _('Id'),
  },
};

const MediaRelaySet: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'MediaRelaySet',
  title: _('Media Relay Set', { count: 2 }),
  path: '/media_relay_sets',
  toStr: (row: MediaRelaySetPropertyList<EntityValue>) => String(row.id),
  properties,
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
  defaultOrderBy: '',
};

export default MediaRelaySet;
