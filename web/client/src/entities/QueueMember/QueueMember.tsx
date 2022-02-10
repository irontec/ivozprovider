import FormatListNumberedIcon from '@mui/icons-material/FormatListNumbered';
import EntityInterface, { foreignKeyResolverType } from 'lib/entities/EntityInterface';
import _ from 'lib/services/translations/translate';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import Form from './Form';
import { QueueMemberProperties, QueueMemberPropertiesList } from './QueueMemberProperties';
import entities from '../index';

const properties: QueueMemberProperties = {
    'queue': {
        label: _('Queue'),
        null: _("Unassigned"),
        default: '__null__',
    },
    'user': {
        label: _('User'),
        null: _("Unassigned"),
        default: '__null__',
    },
    'penalty': {
        label: _('Penalty'),
        required: true,
        minimum: 1,
        helpText: _("Members of lower penalty will be called first. Higher penalty members will be contacted if no members of current penalty are available"),
    },
};

const foreignKeyResolver: foreignKeyResolverType = async function(
    { data }
): Promise<QueueMemberPropertiesList> {

    const { User } = entities;

    for (const row of data) {
        row.userId = row.user;
        row.userLink = User.path + `/${row.userId}/update`;
        row.user = User.toStr(row.user);
    }

    return data;
}

const QueueMember: EntityInterface = {
    ...defaultEntityBehavior,
    icon: FormatListNumberedIcon,
    iden: 'QueueMember',
    title: _('Queue Member', { count: 2 }),
    path: '/queue_members',
    toStr: (row: any) => row.name,
    properties,
    foreignKeyResolver,
    Form,
};

export default QueueMember;