import SettingsApplications from '@mui/icons-material/SettingsApplications';
import EntityInterface from 'lib/entities/EntityInterface';
import _ from 'lib/services/translations/translate';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import genericForeignKeyResolver from 'lib/services/api/genericForeigKeyResolver';
import EntityService from 'lib/services/entity/EntityService';
import entities from '../index';
import View from './View';
import { UsersCdrProperties, UsersCdrRow, UsersCdrRows } from './UsersCdrProperties';

const properties: UsersCdrProperties = {
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
    },
    'party': {
        label: _('Party'),
        readOnly: true,
    },
};

function ownerAndPartyResolver(row: UsersCdrRow, addLinks = true): UsersCdrRow {

    if (row.user) {
        row.owner = row.user;
        if (addLinks) {
            row.ownerId = row.userId;
            row.ownerLink = row.userLink;
        }
    } else if (row.friend) {
        row.owner = row.friend;
        if (addLinks) {
            row.ownerId = row.friendId;
            row.ownerLink = row.friendLink;
        }
    } else if (row.retailAccount) {
        row.owner = row.retailAccount;
        row.ownerId = row.retailAccountId;
        row.ownerLink = row.retailAccountLink;
    } else if (row.residentialDevice) {
        row.owner = row.residentialDevice;
        if (addLinks) {
            row.ownerId = row.residentialDeviceId;
            row.ownerLink = row.residentialDeviceLink;
        }
    } else if (row.direction === 'outbound') {
        row.owner = row.caller;
    } else {
        row.owner = row.callee;
    }

    if (row.direction === 'outbound') {
        row.party = row.callee;
    } else {
        row.party = row.caller;
    }

    return row;
}

export async function foreignKeyResolver(data: UsersCdrRows, entityService: EntityService) {

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

    if (!Array.isArray(data)) {
        return data;
    }

    for (const idx in data) {
        data[idx] = ownerAndPartyResolver(data[idx]);
        data[idx].duration = Math.round(data[idx].duration as number);
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

const usersCdr: EntityInterface = {
    ...defaultEntityBehavior,
    icon: <SettingsApplications />,
    iden: 'UsersCdr',
    title: _('Call', { count: 2 }),
    path: '/users_cdrs',
    properties,
    columns,
    foreignKeyResolver,
    View: View,
};

export default usersCdr;