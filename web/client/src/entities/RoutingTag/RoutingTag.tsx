import SettingsApplications from '@mui/icons-material/SettingsApplications';
import EntityInterface from 'lib/entities/EntityInterface';
import _ from 'lib/services/translations/translate';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import { PartialPropertyList } from 'lib/services/api/ParsedApiSpecInterface';
import selectOptions from './SelectOptions';

const properties: PartialPropertyList = {
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
    icon: SettingsApplications,
    iden: 'RoutingTag',
    title: _('Routing tag', { count: 2 }),
    path: '/routing_tags',
    toStr: (row: any) => {
        return `${row.name} (${row.tag})`;
    },
    properties,
    columns,
    selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
};

export default routingTag;