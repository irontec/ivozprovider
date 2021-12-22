import SettingsApplications from '@mui/icons-material/SettingsApplications';
import EntityInterface from 'lib/entities/EntityInterface';
import _ from 'lib/services/translations/translate';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import Form, { foreignKeyGetter } from './Form';
import { ScheduleProperties } from './ScheduleProperties';

const properties: ScheduleProperties = {
    'name': {
        label: _('Name'),
    },
    'timeIn': {
        label: _('Time in'),
        format: 'time',
    },
    'timeout': {
        label: _('Time out'),
        format: 'time',
    },
    'monday': {
        label: _('Monday'),
        default: 0,
    },
    'tuesday': {
        label: _('Tuesday'),
        default: 0,
    },
    'wednesday': {
        label: _('Wednesday'),
        default: 0,
    },
    'thursday': {
        label: _('Thursday'),
        default: 0,
    },
    'friday': {
        label: _('Friday'),
        default: 0,
    },
    'saturday': {
        label: _('Saturday'),
        default: 0,
    },
    'sunday': {
        label: _('Sunday'),
        default: 0,
    }
};

const columns = [
    'name',
    'timeIn',
    'timeout'
];

const schedule: EntityInterface = {
    ...defaultEntityBehavior,
    icon: <SettingsApplications />,
    iden: 'Schedule',
    title: _('Schedule', { count: 2 }),
    path: '/schedules',
    properties,
    columns,
    Form,
    foreignKeyGetter
};

export default schedule;