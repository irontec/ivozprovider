import FormatListNumberedIcon from '@mui/icons-material/FormatListNumbered';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';

const ConditionalRoutesCondition: EntityInterface = {
    ...defaultEntityBehavior,
    icon: FormatListNumberedIcon,
    iden: 'ConditionalRoutesConditionsRelSchedule',
    title: '',
    path: '/conditional_routes_conditions_rel_schedules',
    acl: {
        ...defaultEntityBehavior.acl,
        iden: 'ConditionalRoutesConditionsRelSchedules',
    },
    toStr: (row: any) => row.id,
    properties: {},
};

export default ConditionalRoutesCondition;