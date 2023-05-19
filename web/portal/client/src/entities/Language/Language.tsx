import { EntityValues } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import AccountTreeIcon from '@mui/icons-material/AccountTree';

const language: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'Language',
  title: _('Language', { count: 2 }),
  path: '/languages',
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'Languages',
  },
  toStr: (row: EntityValues) => `${row.name}`,
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
};

export default language;
