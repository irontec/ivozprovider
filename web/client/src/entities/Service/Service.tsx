import MiscellaneousServicesIcon from '@mui/icons-material/MiscellaneousServices';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { getI18n } from 'react-i18next';
import selectOptions from './SelectOptions';

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
  toStr: (row: any) => {
    const language = getI18n().language.substring(0, 2);

    return row?.name[language];
  },
  selectOptions,
};

export default companyService;
