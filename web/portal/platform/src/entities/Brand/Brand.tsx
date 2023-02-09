import { EntityValue } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import AlbumIcon from '@mui/icons-material/Album';
import { BrandProperties, BrandPropertyList } from './BrandProperties';
import City from './Field/City';
import Country from './Field/Country';
import Nif from './Field/Nif';
import PostalAddress from './Field/PostalAddress';
import PostalCode from './Field/PostalCode';
import Province from './Field/Province';
import RegisterInfo from './Field/RegisterInfo';
import Form from './Form';
import Actions from './Action';

const properties: BrandProperties = {
  currency: {
    label: _('Currency'),
  },
  defaultTimezone: {
    label: _('Default timezone'),
  },
  domainUsers: {
    label: _('SIP domain'),
  },
  nif: {
    label: 'TIN',
    component: Nif,
  },
  language: {
    label: _('Language'),
    default: 1,
  },
  logo: {
    label: _('Logo'),
    type: 'file',
  },
  name: {
    label: _('Name'),
  },
  maxCalls: {
    label: _('Max calls'),
    default: 2,
  },
  features: {
    label: _('Features', { count: 20 }),
    null: _('There are not associated elements'),
  },
  proxyTrunks: {
    label: _('Proxy Trunks', { count: 20 }),
    null: _('There are not associated elements'),
  },
  postalAddress: {
    label: _('Postal Address'),
    component: PostalAddress,
  },
  postalCode: {
    label: _('Postal code'),
    component: PostalCode,
  },
  city: {
    label: _('City'),
    component: City,
  },
  province: {
    label: _('Province'),
    component: Province,
  },
  country: {
    label: _('Country'),
    component: Country,
  },
  registerInfo: {
    label: _('Register Information'),
    component: RegisterInfo,
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
    'nif',
    'logo',
    'postalCode',
    'domainUsers',
    'proxyTrunks',
    'features',
  ],
  customActions: Actions,
  Form,
};

export default Brand;
