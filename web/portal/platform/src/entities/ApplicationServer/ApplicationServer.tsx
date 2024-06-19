import { EntityValue } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import SettingsApplicationsIcon from '@mui/icons-material/SettingsApplications';

import {
  ApplicationServerProperties,
  ApplicationServerPropertyList,
} from './ApplicationServerProperties';

const properties: ApplicationServerProperties = {
  name: {
    label: _('Name'),
  },
  ip: {
    label: _('IP Address'),
  },
};

const ApplicationServer: EntityInterface = {
  ...defaultEntityBehavior,
  icon: SettingsApplicationsIcon,
  link: '/doc/en/administration_portal/platform/infrastructure/application_servers.html',
  iden: 'ApplicationServer',
  title: _('Application Server', { count: 2 }),
  path: '/application_servers',
  toStr: (row: ApplicationServerPropertyList<EntityValue>) =>
    row.name as string,
  properties,
  columns: ['name', 'ip'],
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'ApplicationServers',
  },
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
};

export default ApplicationServer;
