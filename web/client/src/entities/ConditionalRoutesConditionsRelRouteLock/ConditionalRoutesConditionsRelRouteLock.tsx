import FormatListNumberedIcon from '@mui/icons-material/FormatListNumbered';
import EntityInterface from 'lib/entities/EntityInterface';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';

const ConditionalRoutesCondition: EntityInterface = {
    ...defaultEntityBehavior,
    icon: FormatListNumberedIcon,
    iden: 'ConditionalRoutesConditionsRelRouteLock',
    title: '',
    path: '/conditional_routes_conditions_rel_route_locks',
    toStr: (row: any) => row.id,
    properties: {},
};

export default ConditionalRoutesCondition;