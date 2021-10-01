import SettingsApplications from '@mui/icons-material/SettingsApplications';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import _ from 'lib/services/translations/translate';
import EntityInterface from 'lib/entities/EntityInterface';
import { getI18n } from 'react-i18next';

const ratingPlanGroup: EntityInterface = {
    ...defaultEntityBehavior,
    icon: <SettingsApplications />,
    iden: 'RatingPlanGroups',
    title: _('Rating plan groups', { count: 2 }),
    path: '/rating_plan_groups',
    toStr: (row: any) => {
        const language = getI18n().language.substring(0, 2);

        return row?.name[language]
    },
};

export default ratingPlanGroup;