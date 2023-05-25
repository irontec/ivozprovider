import { EntityValues } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import RadioIcon from '@mui/icons-material/Radio';

import {
  MusicOnHoldProperties,
  MusicOnHoldPropertyList,
} from './MusicOnHoldProperties';

const properties: MusicOnHoldProperties = {
  name: {
    label: _('Name'),
  },
  status: {
    label: _('Status'),
    enum: {
      pending: _('Pending'),
      encoding: _('Encoding'),
      ready: _('Ready'),
      error: _('Error'),
    },
  },
  id: {
    label: _('Id'),
  },
  originalFile: {
    label: _('Uploaded file'),
    type: 'file',
    // TODO extensions: [ wav, mp3 ]
    // TODO size_limit: 20M
  },
  encodedFile: {
    label: _('File for play'),
    type: 'file',
    readOnly: true,
  },
};

const MusicOnHold: EntityInterface = {
  ...defaultEntityBehavior,
  icon: RadioIcon,
  iden: 'MusicOnHold',
  title: _('Generic Music on Hold', { count: 2 }),
  path: '/music_on_holds',
  toStr: (row: MusicOnHoldPropertyList<EntityValues>) => `${row.id}`,
  properties,
  columns: ['name', 'originalFile'],
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

export default MusicOnHold;
