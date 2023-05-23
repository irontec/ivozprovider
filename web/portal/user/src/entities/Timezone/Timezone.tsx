import { EntityValues } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import AccountTreeIcon from '@mui/icons-material/AccountTree';

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
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
  toStr: (row: EntityValues) => row.name as string,
};

export default timezone;
