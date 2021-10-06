import SettingsApplications from '@mui/icons-material/SettingsApplications';
import EntityInterface, { PropertiesList } from 'lib/entities/EntityInterface';
import _ from 'lib/services/translations/translate';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';

const properties: PropertiesList = {
    'name': {
        label: 'Name'
    },
};

const calendar: EntityInterface = {
    ...defaultEntityBehavior,
    icon: <SettingsApplications />,
    iden: 'Calendar',
    title: _('Calendar', { count: 2 }),
    path: '/calendars',
    properties,
};

export default calendar;