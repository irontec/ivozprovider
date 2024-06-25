import withCustomComponentWrapper, {
  PropertyCustomFunctionComponent,
  PropertyCustomFunctionComponentProps,
} from '@irontec/ivoz-ui/services/form/Field/CustomComponentWrapper';

import { HolidayDatePropertyList } from '../HolidayDateProperties';

type HolidayDateValues = HolidayDatePropertyList<string | number>;
type TargetGhostType = PropertyCustomFunctionComponent<
  PropertyCustomFunctionComponentProps<HolidayDateValues>
>;

const Type: TargetGhostType = (props): JSX.Element => {
  const { values } = props;
  let target = values.target as React.ReactNode;

  if (values.routeType === 'number') {
    target = values.targetTypeValue as React.ReactNode;
  }

  return <span>{target}</span>;
};

export default withCustomComponentWrapper<HolidayDateValues>(Type);
