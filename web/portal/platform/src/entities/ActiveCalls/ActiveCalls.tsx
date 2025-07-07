import DefaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import CellTowerIcon from '@mui/icons-material/CellTower';

import { ActiveCallProperties } from './ActiveCallsProperties';

const properties: ActiveCallProperties = {
  Brand: {
    label: _('Brand', { count: 1 }),
    $ref: '#/definitions/Brand',
  },
  Company: {
    label: _('Client', { count: 1 }),
    $ref: '#/definitions/Company',
  },
  Carrier: {
    label: _('Carrier', { count: 1 }),
    $ref: '#/definitions/Carrier',
  },
  Direction: {
    label: _('Direction'),
    enum: {
      inbound: _('Inbound'),
      outbound: _('Outbound'),
    },
  },
  DdiProvider: {
    label: _('DDI Provider', { count: 1 }),
    $ref: '#/definitions/DdiProvider',
  },
};

const activeCalls: EntityInterface = {
  ...DefaultEntityBehavior,
  icon: CellTowerIcon,
  columns: ['Brand', 'Company', 'Direction', 'Carrier', 'DdiProvider'],
  link: '/doc/${language}/administration_portal/platform/active_calls.html',
  iden: 'ActiveCalls',
  title: _('Active call', { count: 2 }),
  path: '/active_calls',
  properties,
  acl: {
    create: false,
    read: true,
    detail: false,
    update: false,
    delete: false,
    iden: '_ActiveCalls',
  },
  defaultOrderBy: '',
};

export default activeCalls;
