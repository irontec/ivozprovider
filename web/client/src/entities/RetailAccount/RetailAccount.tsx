import SettingsApplications from '@mui/icons-material/SettingsApplications';
import EntityInterface, { PropertiesList } from 'entities/EntityInterface';
import _ from 'services/Translations/translate';
import defaultEntityBehavior from 'entities/DefaultEntityBehavior';

const properties: PropertiesList = {

};

const retailAccount: EntityInterface = {
    ...defaultEntityBehavior,
    icon: <SettingsApplications />,
    iden: 'RetailAccounts',
    title: _('Retail accounts', { count: 2 }),
    path: '/retail_accounts',
    properties,
};

export default retailAccount;