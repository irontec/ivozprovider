import withCustomComponentWrapper, {
  PropertyCustomFunctionComponent,
  PropertyCustomFunctionComponentProps,
} from '@irontec/ivoz-ui/services/form/Field/CustomComponentWrapper';
import { CallForwardSettingPropertyList } from '../CallForwardSettingProperties';

type CallForwardSettingValues = CallForwardSettingPropertyList<
  string | number | Record<string, string | number>
>;
type TargetGhostType = PropertyCustomFunctionComponent<
  PropertyCustomFunctionComponentProps<CallForwardSettingValues>
>;

const TargetTypeValue: TargetGhostType = (props): JSX.Element => {
  const { values } = props;

  return <span>{values.targetTypeValue as React.ReactNode}</span>;
};

export default withCustomComponentWrapper<CallForwardSettingValues>(
  TargetTypeValue
);
