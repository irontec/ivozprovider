import { EntityValues } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import AccountTreeIcon from '@mui/icons-material/AccountTree';
import { FeatureProperties, FeaturePropertyList } from './FeatureProperties';
import { getI18n } from 'react-i18next';
import selectOptions from './SelectOptions';

const properties: FeatureProperties = {
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

const Feature: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'Feature',
  title: _('Feature', { count: 2 }),
  path: '/features',
  toStr: (row: FeaturePropertyList<EntityValues>) => {
    const language = getI18n().language.substring(0, 2);
    const name = row.name as Record<string, string>;
    return name[language];
  },
  properties,
  selectOptions,
};

export default Feature;
