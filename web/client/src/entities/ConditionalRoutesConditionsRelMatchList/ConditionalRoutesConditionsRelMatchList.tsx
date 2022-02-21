import FormatListNumberedIcon from '@mui/icons-material/FormatListNumbered';
import EntityInterface from 'lib/entities/EntityInterface';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';

const ConditionalRoutesCondition: EntityInterface = {
    ...defaultEntityBehavior,
    icon: FormatListNumberedIcon,
    iden: 'ConditionalRoutesConditionsRelMatchList',
    title: '',
    path: '/conditional_routes_conditions_rel_matchlists',
    toStr: (row: any) => row.id,
    properties: {},
};

export default ConditionalRoutesCondition;