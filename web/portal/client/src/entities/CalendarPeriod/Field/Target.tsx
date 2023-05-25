import withCustomComponentWrapper, {
  PropertyCustomFunctionComponent,
  PropertyCustomFunctionComponentProps,
} from '@irontec/ivoz-ui/services/form/Field/CustomComponentWrapper';

import { CalendarPeriodPropertyList } from '../CalendarPeriodProperties';

type CalendarPeriodValues = CalendarPeriodPropertyList<
  string | number | Record<string, string | number>
>;
type TargetGhostType = PropertyCustomFunctionComponent<
  PropertyCustomFunctionComponentProps<CalendarPeriodValues>
>;

const Target: TargetGhostType = (props): JSX.Element => {
  const { values } = props;
  const { target } = values;

  return <span>{target as React.ReactNode}</span>;
};

export default withCustomComponentWrapper<CalendarPeriodValues>(Target);
