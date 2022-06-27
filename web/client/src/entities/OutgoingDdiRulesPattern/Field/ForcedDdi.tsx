import withCustomComponentWrapper, {
  PropertyCustomFunctionComponent,
  PropertyCustomFunctionComponentProps,
} from '@irontec/ivoz-ui/services/form/Field/CustomComponentWrapper';
import _ from '@irontec/ivoz-ui/services/translations/translate';

import { OutgoingDdiRulesPatternPropertyList } from '../OutgoingDdiRulesPatternProperties';

type OutgoingDdiRulesPatternValues = OutgoingDdiRulesPatternPropertyList<
  string | number | Record<string, string | number>
>;
type TargetGhostType = PropertyCustomFunctionComponent<
  PropertyCustomFunctionComponentProps<OutgoingDdiRulesPatternValues>
>;

const Target: TargetGhostType = (props): JSX.Element => {
  const { values } = props;
  const { action, forcedDdi } = values;

  if (action === 'keep') {
    return <span />;
  }

  if (forcedDdi === null) {
    return <span>{_("Company's default")}</span>;
  }

  return <span>{forcedDdi}</span>;
};

export default withCustomComponentWrapper<OutgoingDdiRulesPatternValues>(
  Target
);
