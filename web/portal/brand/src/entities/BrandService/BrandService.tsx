import { EntityValues } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import BuildIcon from '@mui/icons-material/Build';

import {
  BrandServiceProperties,
  BrandServicePropertyList,
} from './BrandServiceProperties';

const properties: BrandServiceProperties = {
  code: {
    label: _('Code'),
    prefix: <span className='asterisc'>*</span>,
    pattern: new RegExp('[#0-9*]+'),
    helpText: _('Allowed characters are 0-9, * and #'),
  },
  id: {
    label: _('Id'),
  },
  service: {
    label: _('Service', { count: 1 }),
  },
};

const BrandService: EntityInterface = {
  ...defaultEntityBehavior,
  icon: BuildIcon,
  iden: 'BrandService',
  title: _('Brand service', { count: 2 }),
  path: '/brand_services',
  toStr: (row: BrandServicePropertyList<EntityValues>) => `${row.id}`,
  properties,
  columns: ['service', 'code'],
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

export default BrandService;
