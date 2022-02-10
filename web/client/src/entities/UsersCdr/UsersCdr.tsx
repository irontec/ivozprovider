import ChatBubbleOutlineIcon from '@mui/icons-material/ChatBubbleOutline';
import EntityInterface, { foreignKeyResolverType, OrderDirection } from 'lib/entities/EntityInterface';
import _ from 'lib/services/translations/translate';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import genericForeignKeyResolver from 'lib/services/api/genericForeigKeyResolver';
import entities from '../index';
import View from './View';
import { UsersCdrProperties, UsersCdrRow, UsersCdrRows } from './UsersCdrProperties';

const properties: UsersCdrProperties = {
    'startTime': {
        label: _('Start time'),
        readOnly: true,
    },
    'owner': {
        label: _('Owner'),
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
    'party': {
        label: _('Party'),
        readOnly: true,
    },
};

function ownerAndPartyResolver(row: UsersCdrRow, addLinks = true): UsersCdrRow {

    // Owner
    if (row.userId) {
        row.owner = row.user;
        if (addLinks) {
            row.ownerId = row.userId;
            row.ownerLink = row.userLink;
        }
    } else if (row.friendId) {
        row.owner = row.friendId;
        if (addLinks) {
            row.ownerId = row.friendId;
            row.ownerLink = row.friendLink;
        }
    } else if (row.retailAccountId) {
        row.owner = row.retailAccount;
        row.ownerId = row.retailAccountId;
        row.ownerLink = row.retailAccountLink;
    } else if (row.residentialDeviceId) {
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

    // Party
    if (row.direction === 'outbound') {
        row.party = row.callee;
    } else {
        row.party = row.caller;
    }

    return row;
}

export const foreignKeyResolver: foreignKeyResolverType = async function(
    { data, allowLinks = true, cancelToken }
): Promise<UsersCdrRows> {

    const promises = [];
    const { User, Extension, Friend, ResidentialDevice, RetailAccount } = entities;

    promises.push(
        // User & User.extension
        genericForeignKeyResolver({
            data,
            fkFld: 'user',
            entity: {
                ...User,
                toStr: (row: any) => {
                    let response = `${row.name} ${row.lastname}`;
                    if (row.extensionId) {
                        response += ` (${row.extension})`
                    }

                    return response;
                }
            },
            addLink: allowLinks,
            cancelToken,
            dataPreprocesor: async (rows: any) => {
                try {
                    await genericForeignKeyResolver({
                        data: Array.isArray(rows) ? rows : [rows],
                        fkFld: 'extension',
                        entity: Extension,
                        addLink: false,
                        cancelToken,
                    });
                } catch { }

                return rows;
            }
        })
    );

    promises.push(
        genericForeignKeyResolver({
            data,
            fkFld: 'friend',
            entity: Friend,
            cancelToken,
        })
    );

    promises.push(
        genericForeignKeyResolver({
            data,
            fkFld: 'residentialDevice',
            entity: ResidentialDevice,
            cancelToken,
        })
    );

    promises.push(
        genericForeignKeyResolver({
            data,
            fkFld: 'retailAccount',
            entity: RetailAccount,
            cancelToken,
        })
    );

    await Promise.all(promises);

    const iterable = Array.isArray(data)
        ? data
        : [data];

    for (const idx in iterable) {
        iterable[idx] = ownerAndPartyResolver(iterable[idx]);
        iterable[idx].duration = Math.round(iterable[idx].duration as number);
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
    icon: ChatBubbleOutlineIcon,
    iden: 'UsersCdr',
    title: _('Call registry', { count: 2 }),
    path: '/users_cdrs',
    properties,
    columns,
    foreignKeyResolver,
    View,
    defaultOrderBy: 'startTime',
    defaultOrderDirection: OrderDirection.desc,
};

export default usersCdr;