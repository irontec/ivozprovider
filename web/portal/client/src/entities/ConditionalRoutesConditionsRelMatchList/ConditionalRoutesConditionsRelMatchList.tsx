import { EntityValues } from '@irontec-voip/ivoz-ui';
import defaultEntityBehavior from '@irontec-voip/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec-voip/ivoz-ui/entities/EntityInterface';
import FormatListNumberedIcon from '@mui/icons-material/FormatListNumbered';

const ConditionalRoutesCondition: EntityInterface = {
  ...defaultEntityBehavior,
  icon: FormatListNumberedIcon,
  iden: 'ConditionalRoutesConditionsRelMatchList',
  title: '',
  path: '/conditional_routes_conditions_rel_matchlists',
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'ConditionalRoutesConditionsRelMatchLists',
  },
  toStr: (row: EntityValues) => `${row.id}`,
  properties: {},
};

export default ConditionalRoutesCondition;
