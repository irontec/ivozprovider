import SettingsApplications from '@mui/icons-material/SettingsApplications';
import EntityInterface, { PropertiesList } from 'lib/entities/EntityInterface';
import _ from 'lib/services/translations/translate';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';

const properties: PropertiesList = {
    'name': {
        label: _('Name'),
    },
};

const matchList: EntityInterface = {
    ...defaultEntityBehavior,
    icon: <SettingsApplications />,
    iden: 'MatchList',
    title: _('Match List', { count: 2 }),
    path: '/match_lists',
    properties
};

export default matchList;