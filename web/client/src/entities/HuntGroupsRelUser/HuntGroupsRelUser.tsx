import GroupsIcon from '@mui/icons-material/Groups';
import EntityInterface from 'lib/entities/EntityInterface';
import _ from 'lib/services/translations/translate';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import { HuntGroupsRelUserProperties } from './HuntGroupsRelUserProperties';

const properties: HuntGroupsRelUserProperties = {
    'huntGroup': {
        label: _('Hunt Group'),
    },
    'routeType': {
        label: _('Target type'),
    },
    'numberCountry': {
        label: _('Country'),
    },
    'numberValue': {
        label: _('Number'),
    },
    'user': {
        label: _('User'),
    },
    'timeoutTime': {
        label: _('Timeout time'),
    },
    'priority': {
        label: _('Priority'),
    },
    'target': {
        label: _('Target'),
    },
    //'strategy': {
    //    label: _('Strategy'),
    //    required: false,
    //    enum: {
    //        'ringAll': _('Ring all'),
    //        'linear': _('Linear'),
    //        'roundRobin': _('Round Robin'),
    //        'random': _('Random')
    //    },
    //    visualToggle: {
    //        'ringAll': {
    //            show: ['ringAllTimeout'],
    //            hide: [],
    //        },
    //        'linear': {
    //            show: [],
    //            hide: ['ringAllTimeout'],
    //        },
    //        'roundRobin': {
    //            show: [],
    //            hide: ['ringAllTimeout'],
    //        },
    //        'random': {
    //            show: [],
    //            hide: ['ringAllTimeout'],
    //        },
    //    },
    //    helpText: _('Determines the order users will be called')
    //},
    //'preventMissedCalls': {
    //    label: _('Prevent missed calls'),
    //    enum: {
    //        '0': _('No'),
    //        '1': _('Yes'),
    //    },
    //    default: '1',
    //    helpText: _("When 'Yes', calls will never generate a missed call. When 'No', missed calls will be prevented only for RingAll huntgroups if someone answers."),
    //},
};

const huntGroupsRelUser: EntityInterface = {
    ...defaultEntityBehavior,
    icon: <GroupsIcon />,
    iden: 'HuntGroupsRelUser',
    title: _('Hunt Group', { count: 2 }),
    path: '/hunt_groups_rel_users',
    toStr: (row: any) => row.name,
    properties,
};

export default huntGroupsRelUser;