import DnsIcon from '@mui/icons-material/Dns';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { DdiProviderAddressProperties } from './DdiProviderAddressProperties';
import foreignKeyResolver from './ForeignKeyResolver';

const properties: DdiProviderAddressProperties = {
  ip: {
    label: _('IP Address'),
    maxLength: 50,
  },
  description: {
    label: _('Description'),
    maxLength: 200,
  },
  ddiProvider: {
    label: _('DDI Provider'),
  },
};

const DdiProviderAddress: EntityInterface = {
  ...defaultEntityBehavior,
  icon: DnsIcon,
  iden: 'DdiProviderAddress',
  title: _('DDI Provider Address', { count: 2 }),
  path: '/ddi_provider_addresses',
  toStr: (row: any) => row.id,
  properties,
  selectOptions,
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default DdiProviderAddress;
