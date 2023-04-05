import SettingsApplications from '@mui/icons-material/SettingsApplications';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { CountryProperties, CountryPropertyList } from './CountryProperties';
import selectOptions from './SelectOptions';
import { EntityValue } from '@irontec/ivoz-ui';

const properties: CountryProperties = {
  name: {
    label: _('name'),
  },
};

const country: EntityInterface = {
  ...defaultEntityBehavior,
  icon: SettingsApplications,
  iden: 'Country',
  title: _('Country', { count: 2 }),
  path: '/countries',
  toStr: (row: CountryPropertyList<EntityValue>) => row.countryCode as string,
  properties,
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'Countries',
  },
  selectOptions: (props, customProps) => {
    return selectOptions(props, customProps);
  },
};

export default country;
