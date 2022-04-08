import FormatListNumberedIcon from '@mui/icons-material/FormatListNumbered';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';

const ConditionalRoutesCondition: EntityInterface = {
    ...defaultEntityBehavior,
    icon: FormatListNumberedIcon,
    iden: 'ConditionalRoutesConditionsRelRouteLock',
    title: '',
    path: '/conditional_routes_conditions_rel_route_locks',
    acl: {
        ...defaultEntityBehavior.acl,
        iden: 'ConditionalRoutesConditionsRelRouteLocks',
    },
    toStr: (row: any) => row.id,
    properties: {},
};

export default ConditionalRoutesCondition;