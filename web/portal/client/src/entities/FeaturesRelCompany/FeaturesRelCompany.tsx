import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import { EntityValues } from '@irontec/ivoz-ui/services/entity/EntityService';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import AttachFileIcon from '@mui/icons-material/AttachFile';

const FeaturesRelCompany: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AttachFileIcon,
  iden: 'FeaturesRelCompany',
  title: _('FeaturesRelCompany', { count: 2 }),
  path: '/features_rel_companies',
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'FeaturesRelCompanies',
  },
  toStr: (row: EntityValues) =>
    ((row?.feature as EntityValues)?.iden as string) || '',
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
};

export default FeaturesRelCompany;
