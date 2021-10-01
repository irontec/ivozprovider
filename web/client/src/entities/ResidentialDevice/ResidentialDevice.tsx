import SettingsApplications from '@mui/icons-material/SettingsApplications';
import EntityInterface, { PropertiesList } from 'lib/entities/EntityInterface';
import _ from 'lib/services/translations/translate';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';

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