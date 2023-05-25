import { EntityValues } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import SettingsApplications from '@mui/icons-material/SettingsApplications';
import { getI18n } from 'react-i18next';

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
  toStr: (row: EntityValues) => {
    const language = getI18n().language.substring(0, 2);

    return (row?.name as EntityValues)[language] as string;
  },
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
};

export default ratingPlanGroup;
