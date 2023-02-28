import { EntityValue } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import AlbumIcon from '@mui/icons-material/Album';
import { BrandProperties, BrandPropertyList } from './BrandProperties';
import Form from './Form';
import Actions from './Action';
import { foreignKeyGetter } from './ForeignKeyGetter';
import foreignKeyResolver from './ForeignKeyResolver';
import selectOptions from './SelectOptions';

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
  },
};

const Brand: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AlbumIcon,
  iden: 'Brand',
  title: _('Brand', { count: 2 }),
  path: '/brands',
  toStr: (row: BrandPropertyList<EntityValue>) => row.name as string,
  properties,
  columns: [
    'name',
    'invoice.nif',
    'logo',
    'invoice.postalCode',
    'domainUsers',
    'proxyTrunks',
    'features',
  ],
  customActions: Actions,
  Form,
  foreignKeyGetter,
  foreignKeyResolver,
  selectOptions,
};

export default Brand;
