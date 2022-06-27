import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';

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
  toStr: (row: any) => row.name,
  selectOptions: (props, customProps) => {
    return selectOptions(props, customProps);
  },
};

export default language;
