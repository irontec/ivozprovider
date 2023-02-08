import SettingsApplicationsIcon from '@mui/icons-material/SettingsApplications';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import {
  ApplicationServerProperties,
  ApplicationServerPropertyList,
} from './ApplicationServerProperties';
import { EntityValue } from '@irontec/ivoz-ui';

const properties: ApplicationServerProperties = {
  name: {
    label: _('Name'),
  },
  ip: {
    label: _('IP'),
  },
};

const ApplicationServer: EntityInterface = {
  ...defaultEntityBehavior,
  icon: SettingsApplicationsIcon,
  iden: 'ApplicationServer',
  title: _('Application Server', { count: 2 }),
  path: '/application_servers',
  toStr: (row: ApplicationServerPropertyList<EntityValue>) =>
    row.name as string,
  properties,
  columns: ['name', 'ip'],
  selectOptions,
  Form,
};

export default ApplicationServer;
