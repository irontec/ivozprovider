import SettingsApplications from '@mui/icons-material/SettingsApplications';
import EntityInterface from 'lib/entities/EntityInterface';
import _ from 'lib/services/translations/translate';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import { RetailAccountProperties } from './RetailAccountProperties';

const properties: RetailAccountProperties = {

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