import { EntityValue } from '@irontec/ivoz-ui';
import defaultEntityBehavior, {
  foreignKeyGetter,
  foreignKeyResolver,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import CorporateFareIcon from '@mui/icons-material/CorporateFare';
import {
  CorporationProperties,
  CorporationPropertyList,
} from './CorporationProperties';
import Form from './Form';
import selectOptions from './SelectOptions';

const properties: CorporationProperties = {
  name: {
    label: _('Name'),
  },
  description: {
    label: _('Description'),
    default: '',
  },
  id: {
    label: _('Id'),
  },
  brand: {
    label: _('Brand'),
  },
};

const Corporation: EntityInterface = {
  ...defaultEntityBehavior,
  icon: CorporateFareIcon,
  iden: 'Corporation',
  title: _('Corporation', { count: 2 }),
  path: '/corporations',
  toStr: (row: CorporationPropertyList<EntityValue>) => row.name as string,
  columns: ['name', 'description'],
  properties,
  selectOptions,
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default Corporation;
