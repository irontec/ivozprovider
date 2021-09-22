import SettingsApplications from '@mui/icons-material/SettingsApplications';
import EntityInterface, { PropertiesList } from 'entities/EntityInterface';
import _ from 'services/Translations/translate';
import defaultEntityBehavior from 'entities/DefaultEntityBehavior';

const properties: PropertiesList = {
};

const residentialDevice: EntityInterface = {
    ...defaultEntityBehavior,
    icon: <SettingsApplications />,
    iden: 'ResidentialDevice',
    title: _('Residential device', { count: 2 }),
    path: '/residential_devices',
    properties,
};

export default residentialDevice;