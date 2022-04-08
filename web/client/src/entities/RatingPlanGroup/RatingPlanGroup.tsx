import SettingsApplications from '@mui/icons-material/SettingsApplications';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import { getI18n } from 'react-i18next';
import selectOptions from './SelectOptions';

const ratingPlanGroup: EntityInterface = {
    ...defaultEntityBehavior,
    icon: SettingsApplications,
    iden: 'RatingPlanGroup',
    title: _('Rating plan groups', { count: 2 }),
    path: '/rating_plan_groups',
    acl: {
        ...defaultEntityBehavior.acl,
        iden: 'RatingPlanGroups',
    },
    toStr: (row: any) => {
        const language = getI18n().language.substring(0, 2);

        return row?.name[language]
    },
    selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
};

export default ratingPlanGroup;