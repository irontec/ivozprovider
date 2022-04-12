import withCustomComponentWrapper, {
  PropertyCustomFunctionComponent,
  PropertyCustomFunctionComponentProps,
} from '@irontec/ivoz-ui/services/form/Field/CustomComponentWrapper';
import { ConditionalRoutesConditionPropertyList } from '../ConditionalRoutesConditionProperties';

type HuntGroupsRelUserValues = ConditionalRoutesConditionPropertyList<
string | number | Record<string, string | number>
>;
type TargetGhostType = PropertyCustomFunctionComponent<PropertyCustomFunctionComponentProps<HuntGroupsRelUserValues>>;

const Type: TargetGhostType = (props): JSX.Element => {

  const { values } = props;

  return (<span>{values.target}</span>);
};

export default withCustomComponentWrapper<HuntGroupsRelUserValues>(Type);