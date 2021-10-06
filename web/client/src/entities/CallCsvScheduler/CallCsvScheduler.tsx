import SettingsApplications from '@mui/icons-material/SettingsApplications';
import EntityInterface, { PropertiesList } from 'lib/entities/EntityInterface';
import _ from 'lib/services/translations/translate';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import Form from './Form';
import LastExecution from './Field/LastExecution';

const properties: PropertiesList = {
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
    },
    'frequency': {
        label: _('Frequency'),
    },
    'unit': {
        label: _('Unit'),
        enum: {
            'day': _('Day'),
            'week': _('Week'),
            'month': _('Month'),
        }
    },
    'email': {
        label: _('Email'),
        helpText: _('Leave empty if no mail is needed (just generate CSV).'),
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

export const marshaller = (values: any, properties: PropertiesList) => {

    if (values.endpointType) {
        delete values.endpointType;
    };

    const response = defaultEntityBehavior.marshaller(
        values,
        properties
    );

    return response;
}

export const unmarshaller = (row: any, properties: PropertiesList) => {

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
    marshaller,
    unmarshaller
};

export default CallCsvScheduler;