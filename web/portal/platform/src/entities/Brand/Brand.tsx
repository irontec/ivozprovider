import { EntityValue } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import AlbumIcon from '@mui/icons-material/Album';

import Actions from './Action';
import { BrandProperties, BrandPropertyList } from './BrandProperties';

const properties: BrandProperties = {
  domainUsers: {
    label: _('SIP domain'),
  },
  defaultTimezone: {
    label: _('defaultTimezone'),
  },
  currency: {
    label: _('currency'),
  },
  language: {
    label: _('language'),
  },
  invoice: {},
  'invoice.nif': {
    label: _('TIN'),
  },
  'invoice.postalAddress': {
    label: _('Postal address'),
  },
  'invoice.postalCode': {
    label: _('Postal code'),
  },
  'invoice.town': {
    label: _('Town'),
  },
  'invoice.province': {
    label: _('Province'),
  },
  'invoice.registryData': {
    label: _('Resgistry Data'),
  },
  'invoice.country': {
    label: _('Country'),
  },
  logo: {
    label: _('Logo'),
    type: 'file',
  },
  name: {
    label: _('Name'),
  },
  maxCalls: {
    label: _('Max Calls'),
  },
  features: {
    label: _('Features', { count: 20 }),
    null: _('There are not associated elements'),
    type: 'array',
    $ref: '#/definitions/Features',
  },
  proxyTrunks: {
    label: _('Proxy Trunks', { count: 20 }),
    null: _('There are not associated elements'),
    $ref: '#/definitions/ProxyTrunk',
  },
};

const Brand: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AlbumIcon,
  iden: 'Brand',
  title: _('Brand', { count: 2 }),
  path: '/brands',
  deleteDoubleCheck: true,
  toStr: (row: BrandPropertyList<EntityValue>) => row.name as string,
  properties,
  columns: [
    {
      name: 'name',
      size: 10,
    },
    {
      name: 'invoice.nif',
      size: 10,
    },
    {
      name: 'logo',
      size: 10,
    },
    {
      name: 'invoice.postalCode',
      size: 5,
    },
    {
      name: 'domainUsers',
      size: 10,
    },
    {
      name: 'proxyTrunks',
      size: 15,
    },
    {
      name: 'features',
      size: 40,
    },
  ],
  customActions: Actions,
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

export default Brand;
