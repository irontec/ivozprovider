import SettingsApplications from '@material-ui/icons/SettingsApplications';
import EntityInterface, { PropertiesList } from 'entities/EntityInterface';
import _ from 'services/Translations/translate';
import defaultEntityBehavior from 'entities/DefaultEntityBehavior';
import genericForeignKeyResolver from 'services/genericForeigKeyResolver';
import EntityService from 'services/Entity/EntityService';
import entities from '../index';

const properties:PropertiesList = {
    'startTime': {
        label: _('Start time'),
        readOnly: true,
    },
    'duration': {
        label: _('Duration'),
        readOnly: true,
    },
    'direction': {
        label: _('Direction'),
        enum: {
            'inbound': _("Inbound"),
            'outbound': _("Outbound"),
        },
        readOnly: true,
    },
    'caller': {
        label: _('Source'),
        readOnly: true,
    },
    'callee': {
        label: _('Destination'),
        readOnly: true,
    },
    'callid': {
        label: _('Callid'),
        readOnly: true,
    },
    'xcallid': {
        label: _('Xcallid'),
        readOnly: true,
    },
    'callidHash': {
        label: _('CallidHash'),
        readOnly: true,
    },
    'owner': {
        label: _('Owner'),
        readOnly: true,
        //@TODO IvozProvider_Klear_Ghost_UsersCdr
    },
    'party': {
        label: _('Party'),
        readOnly: true,
        //@TODO IvozProvider_Klear_Ghost_UsersCdr
    },
};

async function foreignKeyResolver(data: any, entityService: EntityService) {

    const promises = [];
    const { User, Friend, ResidentialDevice, RetailAccount } = entities;

    promises.push(
        genericForeignKeyResolver(
            data,
            'user',
            User.path,
            User.toStr,
        )
    );

    promises.push(
        genericForeignKeyResolver(
            data,
            'friend',
            Friend.path,
            Friend.toStr,
        )
    );

    promises.push(
        genericForeignKeyResolver(
            data,
            'residentialDevice',
            ResidentialDevice.path,
            ResidentialDevice.toStr,
        )
    );

    promises.push(
        genericForeignKeyResolver(
            data,
            'retailAccount',
            RetailAccount.path,
            RetailAccount.toStr,
        )
    );

    await Promise.all(promises);

    for (const idx in data) {
        if (data[idx].user) {
            data[idx].owner =  data[idx].user;
            data[idx].ownerId =  data[idx].userId;
            data[idx].ownerLink =  data[idx].userLink;
        } else if (data[idx].friend) {
            data[idx].owner =  data[idx].friend;
            data[idx].ownerId =  data[idx].friendId;
            data[idx].ownerLink =  data[idx].friendLink;
        } else if (data[idx].retailAccount) {
            data[idx].owner = data[idx].retailAccount;
            data[idx].ownerId = data[idx].retailAccountId;
            data[idx].ownerLink = data[idx].retailAccountLink;
        } else if (data[idx].residentialDevice) {
            data[idx].owner = data[idx].residentialDevice;
            data[idx].ownerId = data[idx].residentialDeviceId;
            data[idx].ownerLink = data[idx].residentialDeviceLink;
        } else if (data[idx].direction === 'outbound') {
            data[idx].owner = data[idx].caller;
        } else {
            data[idx].owner = data[idx].callee;
        }

        if (data[idx].direction === 'outbound') {
            data[idx].party = data[idx].callee;
        } else {
            data[idx].party = data[idx].caller;
        }

        data[idx].duration = Math.round(data[idx].duration);
    }

    return data;
}

const columns = [
    'startTime',
    'owner',
    'direction',
    'party',
    'duration',
];

const usersCdr:EntityInterface = {
    ...defaultEntityBehavior,
    icon: <SettingsApplications />,
    iden: 'UsersCdr',
    title: _('Call', {count: 2}),
    path: '/users_cdrs',
    properties,
    columns,
    foreignKeyResolver
};

export default usersCdr;