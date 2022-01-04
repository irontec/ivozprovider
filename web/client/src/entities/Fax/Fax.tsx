import SettingsApplications from '@mui/icons-material/SettingsApplications';
import EntityInterface from 'lib/entities/EntityInterface';
import _ from 'lib/services/translations/translate';
import genericForeignKeyResolver from 'lib/services/api/genericForeigKeyResolver';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import Form from './Form';
import { foreignKeyGetter } from './useFkChoices';
import entities from '../index';
import { FaxProperties, FaxPropertiesList } from './FaxProperties';

const properties: FaxProperties = {
    'name': {
        label: _('Name'),
    },
    'email': {
        label: _('Email'),
    },
    'sendByEmail': {
        label: _('Send by email'),
        enum: {
            '0': _('No'),
            '1': _('Yes'),
        },
        default: '1',
        visualToggle: {
            '0': {
                show: [],
                hide: ['email'],
            },
            '1': {
                show: ['email'],
                hide: [],
            },
        }
    },
    'outgoingDdi': {
        label: _('Outgoing DDI'),
        null: _("Client's default")
    },
};

const columns = [
    'name',
    'outgoingDdi',
    'sendByEmail',
    'email',
];

async function foreignKeyResolver(data: FaxPropertiesList): Promise<FaxPropertiesList> {

    const promises = [];
    const { Ddi } = entities;

    promises.push(
        genericForeignKeyResolver(
            data,
            'outgoingDdi',
            Ddi.path,
            Ddi.toStr,
        )
    );

    await Promise.all(promises);

    if (!Array.isArray(data)) {
        return data;
    }

    return data;
}

const fax: EntityInterface = {
    ...defaultEntityBehavior,
    icon: <SettingsApplications />,
    iden: 'Fax',
    title: _('Fax', { count: 2 }),
    path: '/faxes',
    toStr: (row: any) => row.name,
    properties,
    columns,
    Form,
    foreignKeyGetter,
    foreignKeyResolver,
    initialValues: {
        outgoingDdi: null,
    }
};

export default fax;