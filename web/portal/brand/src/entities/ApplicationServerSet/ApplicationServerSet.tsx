import { EntityValue } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import AccountTreeIcon from '@mui/icons-material/AccountTree';

import {
  ApplicationServerSetProperties,
  ApplicationServerSetPropertyList,
} from './ApplicationServerSetProperties';

const properties: ApplicationServerSetProperties = {
  id: {
    label: _('Id'),
  },
  name: {
    label: _('Name'),
  },
  distributeMethod: {
    label: _('Distribute method'),
    enum: {
      rr: _('Round Robin'),
      hash: _('Hash'),
    },
  },
  description: {
    label: _('Description'),
  },
  applicationServers: {
    label: _('Application Server', { count: 2 }),
  },
};

const ApplicationServerSet: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'ApplicationServerSet',
  title: _('Application Server Set', { count: 2 }),
  path: '/application_server_sets',
  toStr: (row: ApplicationServerSetPropertyList<EntityValue>) => String(row.id),
  properties,
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
  defaultOrderBy: '',
};

export default ApplicationServerSet;
