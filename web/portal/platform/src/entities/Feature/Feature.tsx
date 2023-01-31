import { EntityValues } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import AccountTreeIcon from '@mui/icons-material/AccountTree';
import { FeatureProperties, FeaturePropertyList } from './FeatureProperties';
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
  toStr: (row: FeaturePropertyList<EntityValues>) => row.name?.en as string,
  properties,
  selectOptions,
};

export default Feature;
