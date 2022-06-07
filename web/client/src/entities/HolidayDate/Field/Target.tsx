import withCustomComponentWrapper, {
  PropertyCustomFunctionComponent,
  PropertyCustomFunctionComponentProps,
} from '@irontec/ivoz-ui/services/form/Field/CustomComponentWrapper';
import { HolidayDatePropertyList } from '../HolidayDateProperties';

type HolidayDateValues = HolidayDatePropertyList<
string | number
>;
type TargetGhostType = PropertyCustomFunctionComponent<PropertyCustomFunctionComponentProps<HolidayDateValues>>;

const Type: TargetGhostType = (props): JSX.Element => {

  const { values } = props;

  return (<span>{values.target}</span>);
};

export default withCustomComponentWrapper<HolidayDateValues>(Type);