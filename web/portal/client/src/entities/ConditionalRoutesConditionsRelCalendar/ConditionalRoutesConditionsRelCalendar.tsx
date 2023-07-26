import { EntityValues } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import FormatListNumberedIcon from '@mui/icons-material/FormatListNumbered';

const ConditionalRoutesCondition: EntityInterface = {
  ...defaultEntityBehavior,
  icon: FormatListNumberedIcon,
  iden: 'ConditionalRoutesConditionsRelCalendar',
  title: '',
  path: '/conditional_routes_conditions_rel_calendars',
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'ConditionalRoutesConditionsRelCalendars',
  },
  toStr: (row: EntityValues) => `${row.id}`,
  properties: {},
};

export default ConditionalRoutesCondition;
