import { EntityValues } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import AccountTreeIcon from '@mui/icons-material/AccountTree';

import { LanguageProperties, LanguagePropertyList } from './LanguageProperties';

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
  toStr: (row: LanguagePropertyList<EntityValues>) => `${row.name?.en}`,
  properties,
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
};

export default Language;
