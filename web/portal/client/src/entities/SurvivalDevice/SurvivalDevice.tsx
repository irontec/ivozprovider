import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import { EntityValues } from '@irontec/ivoz-ui/services/entity/EntityService';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import WatchLaterIcon from '@mui/icons-material/WatchLater';

import { SurvivalDeviceProperties } from './SurvivalDeviceProperties';

const properties: SurvivalDeviceProperties = {
  name: {
    label: _('Name'),
  },
  proxy: {
    label: _('Proxy'),
  },
  outboundProxy: {
    label: _('Outbound Proxy'),
  },
  description: {
    label: _('Description'),
  },
  udpPort: {
    label: _('UDP port'),
  },
  tcpPort: {
    label: _('TCP port'),
  },
  tlsPort: {
    label: _('TLS port'),
  },
  wssPort: {
    label: _('WSS port'),
  },
};

const columns = ['name', 'proxy', 'description'];

const survivalDevice: EntityInterface = {
  ...defaultEntityBehavior,
  icon: WatchLaterIcon,
  iden: 'SurvivalDevice',
  title: _('Survival Device', { count: 2 }),
  path: '/survival_devices',
  toStr: (row: EntityValues) => (row.name as string) || '',
  properties,
  columns,
  defaultOrderBy: '',
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'SurvivalDevices',
  },
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
};

export default survivalDevice;
