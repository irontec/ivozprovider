import GroupsIcon from '@mui/icons-material/Groups';
import EntityInterface, { foreignKeyResolverType } from 'lib/entities/EntityInterface';
import _ from 'lib/services/translations/translate';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import { HuntGroupsRelUserProperties, HuntGroupsRelUserPropertiesList } from './HuntGroupsRelUserProperties';
import Type from './Field/Target';
import entities from '../index';
import Form from './Form';

const properties: HuntGroupsRelUserProperties = {
    'huntGroup': {
        label: _('Hunt Group'),
    },
    'routeType': {
        label: _('Target type'),
        enum: {
            'user': _('User'),
            'number': _('Number'),
        },
        visualToggle: {
            'user': {
                show: ['user'],
                hide: ['numberCountry', 'numberValue'],
            },
            'number': {
                show: ['numberCountry', 'numberValue'],
                hide: ['user'],
            },
        }
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
        component: Type,
        readOnly: true,
    },
};

const columns = [
    'target',
    'huntGroup',
    'routeType',
    'numberCountry',
    'numberValue',
    'timeoutTime',
    'priority'
];

const foreignKeyResolver: foreignKeyResolverType = async function(
    { data }
): Promise<HuntGroupsRelUserPropertiesList> {

    const { HuntGroup } = entities;
    const iterable = Array.isArray(data)
        ?  data
        : [data];

    for (const idx in iterable) {
        if (typeof iterable[idx].huntGroup === 'string') {
            continue;
        }

        iterable[idx]['huntGroupId'] = iterable[idx].huntGroup.id;
        //data[idx]['huntGroupLink'] = HuntGroup.path + '/edit/' + data[idx].huntGroup.id;
        iterable[idx].huntGroup = HuntGroup.toStr(iterable[idx].huntGroup)
    }

    return data;
}

const huntGroupsRelUser: EntityInterface = {
    ...defaultEntityBehavior,
    icon: GroupsIcon,
    iden: 'HuntGroupsRelUser',
    title: _('Hunt Group member', { count: 2 }),
    path: '/hunt_groups_rel_users',
    toStr: (row: any) => row.name,
    properties,
    columns,
    foreignKeyResolver,
    Form,
};

export default huntGroupsRelUser;