import withCustomComponentWrapper, {
  PropertyCustomFunctionComponent,
  PropertyCustomFunctionComponentProps,
} from '@irontec/ivoz-ui/services/form/Field/CustomComponentWrapper';
import { ConditionalRoutesConditionPropertyList } from '../ConditionalRoutesConditionProperties';

type ConditionalRoutesConditionValues = ConditionalRoutesConditionPropertyList<
  string | number | Record<string, string | number>
>;
type TargetGhostType = PropertyCustomFunctionComponent<
  PropertyCustomFunctionComponentProps<ConditionalRoutesConditionValues>
>;

const Type: TargetGhostType = (props): JSX.Element => {
  const { values } = props;

  return <span>{values.target}</span>;
};

export default withCustomComponentWrapper<ConditionalRoutesConditionValues>(
  Type
);
