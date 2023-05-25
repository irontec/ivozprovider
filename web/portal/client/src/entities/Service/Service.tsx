import { EntityValues } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import MiscellaneousServicesIcon from '@mui/icons-material/MiscellaneousServices';
import { getI18n } from 'react-i18next';

const companyService: EntityInterface = {
  ...defaultEntityBehavior,
  icon: MiscellaneousServicesIcon,
  iden: 'Service',
  title: _('Service', { count: 2 }),
  path: '/services',
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'Services',
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

export default companyService;
