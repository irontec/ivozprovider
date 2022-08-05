import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { BillableCallProperties } from './BillableCallProperties';
import foreignKeyResolver from './ForeignKeyResolver';

const properties: BillableCallProperties = {
  'callid': {
    label: _('Callid'),
  },
  'startTime': {
    label: _('Start Time'),
  },
  'duration': {
    label: _('Duration'),
  },
  'caller': {
    label: _('Caller'),
  },
  'callee': {
    label: _('Callee'),
  },
  'cost': {
    label: _('Cost'),
  },
  'price': {
    label: _('Price'),
  },
  'carrierName': {
    label: _('Carrier Name'),
  },
  'destinationName': {
    label: _('Destination Name'),
  },
  'ratingPlanName': {
    label: _('Rating PlanName'),
  },
  'endpointType': {
    label: _('Endpoint Type'),
    enum: {
      'RetailAccount' : _('Retail Account'),
      'ResidentialDevice' : _('Residential Device'),
      'User' : _('User'),
      'Friend' : _('Friend'),
      'Fax' : _('Fax'),
    },
  },
  'endpointId': {
    label: _('Endpoint Id'),
  },
  'endpointName': {
    label: _('Endpoint Name'),
  },
  'direction': {
    label: _('Direction'),
    enum: {
      'inbound' : _('Inbound'),
      'outbound' : _('Outbound'),
    },
  },
  'id': {
    label: _('Id'),
  },
  'company': {
    label: _('Company'),
  },
  'carrier': {
    label: _('Carrier'),
  },
  'destination': {
    label: _('Destination'),
  },
  'ratingPlanGroup': {
    label: _('Rating PlanGroup'),
  },
  'invoice': {
    label: _('Invoice'),
  },
  'ddi': {
    label: _('Ddi'),
  },
  'ddiProvider': {
    label: _('Ddi Provider'),
  },
};

const BillableCall: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'BillableCall',
  title: _('BillableCall', { count: 2 }),
  path: '/BillableCalls',
  toStr: (row: any) => row.id,
  properties,
  selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default BillableCall;