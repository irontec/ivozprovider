import ForumIcon from '@mui/icons-material/Forum';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import Form from './Form';
import { ConferenceRoomProperties } from './ConferenceRoomProperties';
import selectOptions from './SelectOptions';

const properties: ConferenceRoomProperties = {
  'name': {
    label: _('Name'),
  },
  'pinProtected': {
    label: _('Pin protected'),
    enum: {
      '0': _('No'),
      '1': _('yes'),
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
  'pinCode': {
    label: _('Pin code'),
    required: true,
  },
  'maxMembers': {
    label: _('Max member'),
    default: 0,
  },
};

const conferenceRoom: EntityInterface = {
  ...defaultEntityBehavior,
  icon: ForumIcon,
  iden: 'ConferenceRoom',
  title: _('Conference room', { count: 2 }),
  path: '/conference_rooms',
  toStr: (row: any) => row.name,
  properties,
  columns: [
    'name',
    'maxMembers',
    'pinProtected',
    'pinCode',
  ],
  Form,
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'ConferenceRooms',
  },
  selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
};

export default conferenceRoom;