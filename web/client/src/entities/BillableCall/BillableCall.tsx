import SettingsApplications from '@mui/icons-material/SettingsApplications';
import EntityInterface from 'lib/entities/EntityInterface';
import genericForeignKeyResolver from 'lib/services/api/genericForeigKeyResolver';
import DefaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import _ from 'lib/services/translations/translate';
import Form from './Form';
import { foreignKeyGetter } from './useFkChoices';
import entities from '../index';
import { BillableCallProperties, BillableCallPropertiesList } from './BillableCallProperties';

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

async function foreignKeyResolver(data: BillableCallPropertiesList): Promise<BillableCallPropertiesList> {

    const promises = [];
    const { Ddi } = entities;

    promises.push(
        genericForeignKeyResolver(
            data,
            'ddi',
            Ddi.path,
            Ddi.toStr,
        )
    );

    await Promise.all(promises);

    return data;
}

const columns = [
    'startTime',
    'direction',
    'caller',
    'callee',
    'duration',
    'price',
];

const billableCall: EntityInterface = {
    ...DefaultEntityBehavior,
    icon: <SettingsApplications />,
    iden: 'BillableCall',
    title: _('External call', { count: 2 }),
    path: '/billable_calls',
    properties,
    columns,
    foreignKeyResolver,
    Form,
    foreignKeyGetter
};

export default billableCall;