import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import SettingsApplications from '@mui/icons-material/SettingsApplications';
import { getI18n } from 'react-i18next';
import { CountryProperties } from './CountryProperties';
import selectOptions from './SelectOptions';

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
  toStr: (row: any) => {
    const language = getI18n().language.substring(0, 2);
    return row.name[language];
  },
  properties,
  selectOptions,
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'Countries',
  },
};

export default country;
