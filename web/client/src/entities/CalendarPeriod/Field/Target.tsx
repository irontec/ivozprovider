import withCustomComponentWrapper, {
  PropertyCustomFunctionComponent,
  PropertyCustomFunctionComponentProps,
} from '@irontec/ivoz-ui/services/form/Field/CustomComponentWrapper';
import { CalendarPeriodPropertyList } from '../CalendarPeriodProperties';

type HuntGroupsRelUserValues = CalendarPeriodPropertyList<
string | number | Record<string, string | number>
>;
type TargetGhostType = PropertyCustomFunctionComponent<PropertyCustomFunctionComponentProps<HuntGroupsRelUserValues>>;

const Target: TargetGhostType = (props): JSX.Element => {

  const { values } = props;
  const { target } = values;

  return (<span>{target}</span>);
};

export default withCustomComponentWrapper<HuntGroupsRelUserValues>(Target);