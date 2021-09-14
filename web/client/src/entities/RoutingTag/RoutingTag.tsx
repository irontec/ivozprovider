import SettingsApplications from '@material-ui/icons/SettingsApplications';
import EntityInterface, { PropertiesList } from 'entities/EntityInterface';
import _ from 'services/Translations/translate';
import defaultEntityBehavior from 'entities/DefaultEntityBehavior';

const properties: PropertiesList = {
    'name': {
        label: _('Name'),
    },
    'tag': {
        label: _('Tag'),
    },
};

const columns = [
    'name',
    'tag',
];

const routingTag: EntityInterface = {
    ...defaultEntityBehavior,
    icon: <SettingsApplications />,
    iden: 'RoutingTag',
    title: _('Routing tag', { count: 2 }),
    path: '/routing_tags',
    toStr: (row: any) => {
        return `${row.name} (${row.tag})`;
    },
    properties,
    columns,
};

export default routingTag;