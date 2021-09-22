import SettingsApplications from '@mui/icons-material/SettingsApplications';
import EntityInterface, { PropertiesList } from 'entities/EntityInterface';
import _ from 'services/Translations/translate';
import defaultEntityBehavior from 'entities/DefaultEntityBehavior';
import Form from './Form';

const properties: PropertiesList = {
    'name': {
        label: _('Name'),
    },
    'pinProtected': {
        label: _('Pin protected'),
        enum: {
            '0': _("No"),
            '1': _("yes"),
        },
        visualToggle: {
            '0': {
                show: [],
                hide: ['pinCode'],
            },
            '1': {
                show: ['pinCode'],
                hide: [],
            },
        }
    },
    'pinCode': {
        label: _('Pin code'),
    },
    'maxMembers': {
        label: _('Max member'),
    },
};

const conferenceRoom: EntityInterface = {
    ...defaultEntityBehavior,
    icon: <SettingsApplications />,
    iden: 'ConferenceRoom',
    title: _('Conference room', { count: 2 }),
    path: '/conference_rooms',
    toStr: (row: any) => row.name,
    properties,
    Form
};

export default conferenceRoom;