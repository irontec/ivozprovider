import { EntityValue } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface, {
  OrderDirection,
} from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import ChatBubbleIcon from '@mui/icons-material/ChatBubble';

import Actions from './Action';
import {
  BillableCallProperties,
  BillableCallPropertyList,
} from './BillableCallProperties';

const properties: BillableCallProperties = {
  callid: {
    label: _('Call ID'),
  },
  startTime: {
    label: _('Start time'),
  },
  duration: {
    label: _('Duration'),
  },
  caller: {
    label: _('Caller'),
  },
  brand: {
    label: _('Brand', { count: 1 }),
  },
  callee: {
    label: _('Callee'),
  },
  cost: {
    label: _('Cost'),
  },
  price: {
    label: _('Price'),
  },
  carrierName: {
    label: _('Carrier', { count: 1 }),
  },
  destinationName: {
    label: _('Destination', { count: 1 }),
  },
  ratingPlanName: {
    label: _('Rating plan', { count: 1 }),
  },
  endpointType: {
    label: _('Endpoint Type'),
    enum: {
      RetailAccount: _('Retail Account', { count: 1 }),
      ResidentialDevice: _('Residential Device', { count: 1 }),
      User: _('User', { count: 1 }),
      Friend: _('Friend', { count: 1 }),
      Fax: _('Fax', { count: 1 }),
    },
  },
  endpointId: {
    label: _('Endpoint id'),
  },
  endpointName: {
    label: _('Endpoint name'),
  },
  direction: {
    label: _('Direction'),
    enum: {
      inbound: _('Inbound'),
      outbound: _('Outbound'),
    },
  },
  id: {
    label: _('Id'),
  },
  company: {
    label: _('Client', { count: 1 }),
  },
  carrier: {
    label: _('Carrier', { count: 1 }),
  },
  invoice: {
    label: _('Invoice', { count: 1 }),
    null: _('Unassigned'),
  },
  ddi: {
    label: _('DDI', { count: 1 }),
  },
  ddiProvider: {
    label: _('DDI Provider', { count: 1 }),
    null: _('Unassigned'),
  },
};

const BillableCall: EntityInterface = {
  ...defaultEntityBehavior,
  icon: ChatBubbleIcon,
  link: '/doc/en/administration_portal/platform/external_calls.html',
  iden: 'BillableCall',
  title: _('External call', { count: 2 }),
  path: '/billable_calls',
  toStr: (row: BillableCallPropertyList<EntityValue>) => row.callid as string,
  properties,
  defaultOrderDirection: OrderDirection.desc,
  columns: [
    'startTime',
    'brand',
    'company',
    'direction',
    'caller',
    'callee',
    'duration',
    'price',
    'cost',
    'invoice',
  ],
  acl: {
    iden: 'BillableCalls',
    read: true,
    detail: true,
    create: false,
    update: false,
    delete: false,
  },
  customActions: Actions,
  foreignKeyResolver: async () => {
    const module = await import('./ForeignKeyResolver');

    return module.default;
  },
  foreignKeyGetter: async () => {
    const module = await import('./ForeignKeyGetter');

    return module.foreignKeyGetter;
  },
  View: async () => {
    const module = await import('./View');

    return module.default;
  },
};

export default BillableCall;
