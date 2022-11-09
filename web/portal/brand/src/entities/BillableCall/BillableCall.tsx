import ChatBubbleIcon from '@mui/icons-material/ChatBubble';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { BillableCallProperties } from './BillableCallProperties';
import foreignKeyResolver from './ForeignKeyResolver';

const properties: BillableCallProperties = {
  callid: {
    label: _('Call ID'),
    maxLength: 128,
  },
  startTime: {
    label: _('Start time'),
    format: 'date-time',
  },
  duration: {
    label: _('Duration'),
  },
  caller: {
    label: _('Caller'),
  },
  callee: {
    label: _('Callee'),
    maxLength: 128,
  },
  cost: {
    label: _('Cost'),
  },
  price: {
    label: _('Price'),
  },
  carrierName: {
    label: _('Carrier'),
  },
  destinationName: {
    label: _('Destination'),
    maxLength: 100,
  },
  ratingPlanName: {
    label: _('Rating plan'),
  },
  endpointType: {
    label: _('Endpoint type'),
    enum: {
      RetailAccount: _('Retail Account'),
      ResidentialDevice: _('Residential Device'),
      User: _('User'),
      Friend: _('Friend'),
      Fax: _('Fax'),
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
    label: _('Client'),
  },
  carrier: {
    label: _('Carrier'),
  },
  destination: {
    label: _('Destination'),
  },
  ratingPlanGroup: {
    label: _('Rating PlanGroup'),
  },
  invoice: {
    label: _('Invoice'),
    null: _('Unassigned'),
  },
  ddi: {
    label: _('DDI'),
  },
  ddiProvider: {
    label: _('DDI Provider'),
    null: _('Unassigned'),
  },
};

const BillableCall: EntityInterface = {
  ...defaultEntityBehavior,
  icon: ChatBubbleIcon,
  iden: 'BillableCall',
  title: _('External call', { count: 2 }),
  path: '/billable_calls',
  toStr: (row: any) => row.id,
  properties,
  columns: [
    'startTime',
    'company',
    'duration',
    'caller',
    'callee',
    'duration',
    'price',
    'cost',
    'invoice',
  ],
  acl: {
    read: true,
    detail: true,
    create: false,
    update: false,
    delete: false,
  },
  selectOptions,
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default BillableCall;
