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
    },
    'tuesday': {
        label: _('Tuesday'),
    },
    'wednesday': {
        label: _('Wednesday'),
    },
    'thursday': {
        label: _('Thursday'),
    },
    'friday': {
        label: _('Friday'),
    },
    'saturday': {
        label: _('Saturday'),
    },
    'sunday': {
        label: _('Sunday'),
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