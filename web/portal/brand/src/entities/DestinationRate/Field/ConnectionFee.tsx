import withCustomComponentWrapper, {
  PropertyCustomFunctionComponent,
  PropertyCustomFunctionComponentProps,
} from '@irontec/ivoz-ui/services/form/Field/CustomComponentWrapper';
import { DestinationRatePropertyList } from '../DestinationRateProperties';

type DestinationRateValues = DestinationRatePropertyList<
  string | number | Record<string, string | number>
>;
type TargetGhostType = PropertyCustomFunctionComponent<
  PropertyCustomFunctionComponentProps<DestinationRateValues>
>;

const ConnectionFee: TargetGhostType = (props): JSX.Element => {
  const { values } = props;
  const { connectFee, currencySymbol } = values;

  const value = `${connectFee} ${currencySymbol}`;

  return <span>{value}</span>;
};

export default withCustomComponentWrapper<DestinationRateValues>(ConnectionFee);
