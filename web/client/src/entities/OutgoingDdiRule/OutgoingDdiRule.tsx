import SettingsApplications from '@mui/icons-material/SettingsApplications';
import EntityInterface from 'lib/entities/EntityInterface';
import _ from 'lib/services/translations/translate';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import Form, { foreignKeyGetter } from './Form'
import { EntityValues } from 'lib/services/entity/EntityService';
import entities from '../index';
import genericForeignKeyResolver from 'lib/services/api/genericForeigKeyResolver';
import { PartialPropertyList } from 'lib/services/api/ParsedApiSpecInterface';

const properties: PartialPropertyList = {
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


async function foreignKeyResolver(data: EntityValues): Promise<EntityValues> {

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
    foreignKeyGetter,
    foreignKeyResolver
};

export default outgoingDdiRule;