import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import AccountTreeIcon from '@mui/icons-material/AccountTree';
import selectOptions from './SelectOptions';

const timezone: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'Timezones',
  title: _('Timezone', { count: 2 }),
  path: '/timezones',
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'Timezones',
  },
  selectOptions,
  toStr: (row: any) => row.name,
};

export default timezone;
