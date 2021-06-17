import SettingsApplications from '@material-ui/icons/SettingsApplications';
import EntityInterface, { PropertiesList } from 'entities/EntityInterface';
import _ from 'services/Translations/translate';
import defaultEntityBehavior from '../DefaultEntityBehavior';

const properties:PropertiesList = {
    'name': {
        label: 'Name'
    },
};

const calendar:EntityInterface = {
    ...defaultEntityBehavior,
    icon: <SettingsApplications />,
    iden: 'Calendar',
    title: _('Calendar', {count: 2}),
    path: '/calendars',
    properties,
};

export default calendar;