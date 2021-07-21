import SettingsApplications from '@material-ui/icons/SettingsApplications';
import EntityInterface, { PropertiesList } from 'entities/EntityInterface';
import _ from 'services/Translations/translate';
import defaultEntityBehavior from 'entities/DefaultEntityBehavior';

const properties:PropertiesList = {};

const country:EntityInterface = {
    ...defaultEntityBehavior,
    icon: <SettingsApplications />,
    iden: 'Country',
    title: _('Country', {count: 2}),
    path: '/countries',
    toStr: (row:any) => `${row.name.en}`, //@TODO detect language
    properties,
};

export default country;