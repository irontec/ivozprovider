import ChatBubbleIcon from '@mui/icons-material/ChatBubble';
import EntityInterface, { OrderDirection } from '@irontec/ivoz-ui/entities/EntityInterface';
import DefaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import Form from './Form';
import { BillableCallProperties } from './BillableCallProperties';
import View from './View';

const properties: BillableCallProperties = {
    'startTime': {
        label: 'Start time',
    },
    'callid': {
        label: 'Call ID',
    },
    'caller': {
        label: 'Caller',
    },
    'callee': {
        label: 'Callee',
    },
    'destinationName': {
        label: 'Destination',
    },
    'direction': {
        label: 'Direction',
        enum: {
            'inbound': _('Inbound'),
            'outbound': _('Outbound'),
        }
    },
    'invoice': {
        label: 'Invoice',
    },
    'price': {
        label: 'Price',
    },
    'duration': {
        label: 'Duration',
    },
    'cost': {
        label: 'Cost',
    },
    'carrierName': {
        label: 'Carrier',
    },
    'ratingPlanName': {
        label: 'Rating plan',
    },
    'endpointType': {
        label: 'Endpoint type',
    },
    'endpointId': {
        label: 'Endpoint id',
    },
    'endpointName': {
        label: 'Endpoint name',
    },
    'ddiProvider': {
        label: 'DDI Provider',
    },
};

const columns = [
    'startTime',
    'direction',
    'caller',
    'callee',
    'duration'
];

const billableCall: EntityInterface = {
    ...DefaultEntityBehavior,
    icon: ChatBubbleIcon,
    iden: 'BillableCall',
    title: _('External call', { count: 2 }),
    path: '/billable_calls',
    properties,
    columns,
    Form,
    View,
    defaultOrderBy: 'startTime',
    defaultOrderDirection: OrderDirection.desc,
};

export default billableCall;