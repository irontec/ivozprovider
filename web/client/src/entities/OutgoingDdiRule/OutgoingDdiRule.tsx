import SettingsApplications from '@mui/icons-material/SettingsApplications';
import EntityInterface, { PropertiesList } from 'entities/EntityInterface';
import _ from 'services/Translations/translate';
import defaultEntityBehavior from 'entities/DefaultEntityBehavior';
import Form from './Form'
import EntityService from 'services/Entity/EntityService';
import entities from '../index';
import genericForeignKeyResolver from 'services/genericForeigKeyResolver';

const properties: PropertiesList = {
    'name': {
        label: _('Name'),
    },
    'defaultAction': {
        label: _('Default Action'),
        enum: {
            'keep': _("Keep Original DDI"),
            'force': _("Force DDI"),
        },
        visualToggle: {
            'keep': {
                show: [],
                hide: ['forcedDdi'],
            },
            'force': {
                show: ['forcedDdi'],
                hide: [],
            },
        }
    },
    'forcedDdi': {
        label: _('Forced DDI'),
    }
};


async function foreignKeyResolver(data: any, entityService: EntityService) {

    const promises = [];
    const { Ddi } = entities;

    promises.push(
        genericForeignKeyResolver(
            data,
            'forcedDdi',
            Ddi.path,
            Ddi.toStr,
            Ddi.acl.update
        )
    );

    await Promise.all(promises);

    return data;
}

const columns = [
    'name',
    'defaultAction',
    'forcedDdi',
];

const outgoingDdiRule: EntityInterface = {
    ...defaultEntityBehavior,
    icon: <SettingsApplications />,
    iden: 'OutgoingDdiRule',
    title: _('Outgoing DDI Rule', { count: 2 }),
    path: '/outgoing_ddi_rules',
    properties,
    columns,
    Form,
    foreignKeyResolver
};

export default outgoingDdiRule;