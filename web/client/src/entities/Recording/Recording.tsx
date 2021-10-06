import SettingsApplications from '@mui/icons-material/SettingsApplications';
import EntityInterface, { PropertiesList } from 'lib/entities/EntityInterface';
import _ from 'lib/services/translations/translate';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import TypeGhost from './Field/TypeGhost';

const properties: PropertiesList = {
    'callid': {
        label: _('Callid'),
    },
    'calldate': {
        label: _('Calldate'),
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
    'type': {
        label: _('Type'),
        enum: {
            'ondemand': _('On-demand'),
            'ddi': _('DDI'),
        }
    },
    'typeGhost': {
        label: _('Type'),
        component: TypeGhost,
    },
    'recordedFile': {
        label: _('Recorded file'),
    },
};

const columns = [
    'calldate',
    'typeGhost',
    'caller',
    'callee',
    'duration',
];

const recording: EntityInterface = {
    ...defaultEntityBehavior,
    icon: <SettingsApplications />,
    iden: 'Recording',
    title: _('Recording', { count: 2 }),
    path: '/recordings',
    properties,
    columns,
};

export default recording;