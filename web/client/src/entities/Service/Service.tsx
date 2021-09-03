import SettingsApplications from '@material-ui/icons/SettingsApplications';
import EntityInterface from 'entities/EntityInterface';
import _ from 'services/Translations/translate';
import defaultEntityBehavior from 'entities/DefaultEntityBehavior';
import { getI18n } from 'react-i18next';

const companyService: EntityInterface = {
    ...defaultEntityBehavior,
    icon: <SettingsApplications />,
    iden: 'Service',
    title: _('Service', { count: 2 }),
    path: '/services',
    toStr: (row: any) => {
        const language = getI18n().language.substring(0, 2);

        return row?.name[language]
    },
};

export default companyService;