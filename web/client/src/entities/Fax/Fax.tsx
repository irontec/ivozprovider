import SettingsApplications from '@material-ui/icons/SettingsApplications';
import EntityInterface, { PropertiesList } from 'entities/EntityInterface';
import _ from 'services/Translations/translate';
import EntityService from 'services/Entity/EntityService';
import genericForeignKeyResolver from 'services/genericForeigKeyResolver';
import defaultEntityBehavior from 'entities/DefaultEntityBehavior';
import Form from './Form';
import entities from '../index';

const properties:PropertiesList = {
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

async function foreignKeyResolver(data: any, entityService: EntityService) {

    const promises= [];
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

    return data;
}

const fax:EntityInterface = {
    ...defaultEntityBehavior,
    icon: <SettingsApplications />,
    iden: 'Fax',
    title: _('Fax', {count: 2}),
    path: '/faxes',
    toStr: (row:any) => row.name,
    properties,
    columns,
    Form,
    foreignKeyResolver,
    initialValues: {
        outgoingDdi: null,
    }
};

export default fax;