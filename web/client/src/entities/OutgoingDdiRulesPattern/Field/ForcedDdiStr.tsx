import withCustomComponentWrapper, {
  PropertyCustomFunctionComponent,
  PropertyCustomFunctionComponentProps,
} from '@irontec/ivoz-ui/services/form/Field/CustomComponentWrapper';
import _ from '@irontec/ivoz-ui/services/translations/translate';

import { OutgoingDdiRulesPatternPropertyList } from '../OutgoingDdiRulesPatternProperties';

type OutgoingDdiRulesPatternValues = OutgoingDdiRulesPatternPropertyList<
  string | number | Record<string, string | number>
>;
type ForcedDdiStrType = PropertyCustomFunctionComponent<
  PropertyCustomFunctionComponentProps<OutgoingDdiRulesPatternValues>
>;

const ForcedDdiStr: ForcedDdiStrType = (props): JSX.Element | null => {
  const { values } = props;
  const { action, forcedDdi } = values;

  if (action === 'keep') {
    return null;
  }

  if (forcedDdi === null) {
    return <span>{_("Company's default")}</span>;
  }

  if (typeof forcedDdi !== 'string') {
    return null;
  }

  return <span>{forcedDdi}</span>;
};

export default withCustomComponentWrapper<OutgoingDdiRulesPatternValues>(
  ForcedDdiStr
);
