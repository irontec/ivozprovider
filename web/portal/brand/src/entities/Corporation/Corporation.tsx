import { EntityValue } from '@irontec/ivoz-ui';
import defaultEntityBehavior, {
  foreignKeyGetter,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import CorporateFareIcon from '@mui/icons-material/CorporateFare';

import {
  CorporationProperties,
  CorporationPropertyList,
} from './CorporationProperties';

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
  link: '/doc/${language}/administration_portal/brand/settings/corporations.html',
  iden: 'Corporation',
  title: _('Corporation', { count: 2 }),
  path: '/corporations',
  toStr: (row: CorporationPropertyList<EntityValue>) => row.name as string,
  columns: ['name', 'description'],
  properties,
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'Corporations',
  },
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
  foreignKeyGetter: async () => {
    return foreignKeyGetter;
  },
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
  defaultOrderBy: '',
};

export default Corporation;
