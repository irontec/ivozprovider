import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import AudiotrackIcon from '@mui/icons-material/Audiotrack';

import { MusicOnHoldProperties } from './MusicOnHoldProperties';

const properties: MusicOnHoldProperties = {
  name: {
    label: _('Name'),
  },
  originalFile: {
    label: _('Uploaded file'),
    type: 'file',
  },
};

const musicOnHold: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AudiotrackIcon,
  link: '/doc/en/administration_portal/client/vpbx/multimedia/music_on_hold.html',
  iden: 'MusicOnHold',
  title: _('Music on hold', { count: 2 }),
  path: '/music_on_holds',
  properties,
  defaultOrderBy: '',
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'MusicOnHold',
  },
};

export default musicOnHold;
