import SettingsApplications from '@material-ui/icons/SettingsApplications';
import EntityInterface, { PropertiesList } from 'entities/EntityInterface';
import _ from 'services/Translations/translate';
import defaultEntityBehavior from 'entities/DefaultEntityBehavior';

const properties: PropertiesList = {
    'name': {
        label: _('Name'),
    },
    originalFile: {
        label: _('Uploaded file'),
        type: 'file'
    }
};

const musicOnHold: EntityInterface = {
    ...defaultEntityBehavior,
    icon: <SettingsApplications />,
    iden: 'MusicOnHold',
    title: _('Music on hold', { count: 2 }),
    path: '/music_on_holds',
    properties
};

export default musicOnHold;