import withCustomComponentWrapper, {
  PropertyCustomFunctionComponent,
  PropertyCustomFunctionComponentProps,
} from '@irontec/ivoz-ui/services/form/Field/CustomComponentWrapper';

import { DestinationRatePropertyList } from '../DestinationRateProperties';

type CalendarPeriodValues = DestinationRatePropertyList<
  string | number | Record<string, string | number>
>;
type TargetGhostType = PropertyCustomFunctionComponent<
  PropertyCustomFunctionComponentProps<CalendarPeriodValues>
>;

const Cost: TargetGhostType = (props): JSX.Element => {
  const { values } = props;
  const { cost, currencySymbol } = values;

  const value = `${cost} ${currencySymbol}`;

  return <span>{value}</span>;
};

export default withCustomComponentWrapper<CalendarPeriodValues>(Cost);
