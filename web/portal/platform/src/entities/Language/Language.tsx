import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import { LanguageProperties, LanguagePropertyList } from './LanguageProperties';
import { EntityValue } from '@irontec/ivoz-ui';

const properties: LanguageProperties = {
  iden: {
    label: _('Iden'),
  },
  id: {
    label: _('Id'),
  },
  name: {
    label: _('Name'),
  },
};

const Language: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'Language',
  title: _('Language', { count: 2 }),
  path: '/languages',
  toStr: (row: LanguagePropertyList<EntityValue>) => row.name as string,
  properties,
  selectOptions,
};

export default Language;
