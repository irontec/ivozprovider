import WatchLaterIcon from '@mui/icons-material/WatchLater';
import EntityInterface from 'lib/entities/EntityInterface';
import _ from 'lib/services/translations/translate';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import Form from './Form';
import { ScheduleProperties } from './ScheduleProperties';
import { EntityValues } from 'lib/services/entity/EntityService';

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
    icon: WatchLaterIcon,
    iden: 'Schedule',
    title: _('Schedule', { count: 2 }),
    path: '/schedules',
    toStr: (row: EntityValues) => (row.name as string || ''),
    properties,
    columns,
    Form,
};

export default schedule;