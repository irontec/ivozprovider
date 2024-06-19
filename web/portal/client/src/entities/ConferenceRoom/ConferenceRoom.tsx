import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import ForumIcon from '@mui/icons-material/Forum';

import {
  ConferenceRoomProperties,
  ConferenceRoomPropertyList,
} from './ConferenceRoomProperties';

const properties: ConferenceRoomProperties = {
  name: {
    label: _('Name'),
  },
  pinProtected: {
    label: _('Pin protected'),
    enum: {
      '0': _('No'),
      '1': _('Yes'),
    },
    default: '0',
    visualToggle: {
      '0': {
        show: [],
        hide: ['pinCode'],
      },
      '1': {
        show: ['pinCode'],
        hide: [],
      },
    },
  },
  pinCode: {
    label: _('Pin code'),
    required: true,
  },
  maxMembers: {
    label: _('Max member'),
    default: 0,
  },
  announceUserCount: {
    label: _('Announce user count'),
    enum: {
      first: _('First member'),
      always: _('Always'),
    },
  },
};

const conferenceRoom: EntityInterface = {
  ...defaultEntityBehavior,
  icon: ForumIcon,
  link: '/doc/en/administration_portal/client/vpbx/routing_endpoints/conference_rooms.html',
  iden: 'ConferenceRoom',
  title: _('Conference room', { count: 2 }),
  path: '/conference_rooms',
  toStr: (row: ConferenceRoomPropertyList<string>) => `${row.name}`,
  properties,
  columns: ['name', 'maxMembers', 'pinProtected', 'pinCode'],
  defaultOrderBy: '',
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'ConferenceRooms',
  },
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
};

export default conferenceRoom;
