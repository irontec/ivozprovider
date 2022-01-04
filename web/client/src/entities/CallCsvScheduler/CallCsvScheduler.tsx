import SettingsApplications from '@mui/icons-material/SettingsApplications';
import EntityInterface from 'lib/entities/EntityInterface';
import _ from 'lib/services/translations/translate';
import defaultEntityBehavior, { MarshallerValues } from 'lib/entities/DefaultEntityBehavior';
import Form from './Form';
import { foreignKeyGetter } from './useFkChoices';
import LastExecution from './Field/LastExecution';
import { CallCsvSchedulerProperties } from './CallCsvSchedulerProperties';
import { PartialPropertyList } from 'lib/services/api/ParsedApiSpecInterface';

const properties: CallCsvSchedulerProperties = {
    'name': {
        label: _('Name'),
    },
    'callDirection': {
        label: _('Direction'),
        enum: {
            'outbound': _('Outbound'),
            'inbound': _('Inbound'),
        },
        null: _('Both'),
        default: '__null__',
    },
    'frequency': {
        label: _('Frequency'),
        default: 1,
    },
    'unit': {
        label: _('Unit'),
        enum: {
            'day': _('Day'),
            'week': _('Week'),
            'month': _('Month'),
        },
        default: 'month',
    },
    'email': {
        label: _('Email'),
        helpText: _('Leave empty if no mail is needed (just generate CSV).'),
        default: '',
    },
    'lastExecution': {
        label: _('Last execution'),
        component: LastExecution,
    },
    'nextExecution': {
        label: _('Next execution'),
    },
    'brand': {
        label: _('Brand'),
    },
    'callCsvNotificationTemplate': {
        label: _('Notification template'),
    },
    'ddi': {
        label: _('DDI'),
    },
    'retailAccount': {
        label: _('Retail Account'),
    },
    'residentialDevice': {
        label: _('Residential Device'),
    },
    'endpointType': {
        label: _('Endpoint type'),
        enum: {
            user: _('User'),
            fax: _('Fax'),
            friend: _('Friend'),
        },
        null: _('All'),
        visualToggle: {
            '__null__': {
                show: [],
                hide: ['user', 'fax', 'friend'],
            },
            'user': {
                show: ['user'],
                hide: ['fax', 'friend'],
            },
            'fax': {
                show: ['fax'],
                hide: ['user', 'friend'],
            },
            'friend': {
                show: ['friend'],
                hide: ['user', 'fax', 'friend'],
            }
        }
    },
    'user': {
        label: _('User'),
    },
    'fax': {
        label: _('Fax'),
    },
    'friend': {
        label: _('Friend'),
    },
};

const columns = [
    'name',
    'callDirection',
    'email',
    'frequency',
    'unit',
    'lastExecution',
    'nextExecution',
];

export const marshaller = (
    values: CallCsvSchedulerProperties,
    properties: PartialPropertyList
): MarshallerValues => {

    if (values.endpointType) {
        delete values.endpointType;
    }

    const response = defaultEntityBehavior.marshaller(
        values,
        properties
    );

    return response;
}

export const unmarshaller = (
    row: CallCsvSchedulerProperties,
    properties: PartialPropertyList
): MarshallerValues => {

    const response = defaultEntityBehavior.unmarshaller(
        row,
        properties
    );

    if (response.user) {
        response.endpointType = 'user';
    } else if (response.fax) {
        response.endpointType = 'fax';
    } else if (response.friend) {
        response.endpointType = 'friend';
    } else {
        response.endpointType = '__null__';
    }

    return response;
};

const CallCsvScheduler: EntityInterface = {
    ...defaultEntityBehavior,
    icon: <SettingsApplications />,
    iden: 'CallCsvScheduler',
    title: _('Call csv scheduler', { count: 2 }),
    path: '/call_csv_schedulers',
    properties,
    columns,
    Form,
    foreignKeyGetter,
    marshaller,
    unmarshaller
};

export default CallCsvScheduler;