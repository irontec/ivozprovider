import { EntityValues } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import AccountTreeIcon from '@mui/icons-material/AccountTree';
import { getI18n } from 'react-i18next';

import { FeatureProperties, FeaturePropertyList } from './FeatureProperties';

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

    return `${row.name?.[language]}`;
  },
  properties,
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'Features',
  },
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
  foreignKeyResolver: async () => {
    const module = await import('./ForeignKeyResolver');

    return module.default;
  },
  foreignKeyGetter: async () => {
    const module = await import('./ForeignKeyGetter');

    return module.foreignKeyGetter;
  },
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
};

export default Feature;
