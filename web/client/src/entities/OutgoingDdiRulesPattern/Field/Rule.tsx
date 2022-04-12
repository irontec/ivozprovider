import withCustomComponentWrapper, {
  PropertyCustomFunctionComponent,
  PropertyCustomFunctionComponentProps,
} from '@irontec/ivoz-ui/services/form/Field/CustomComponentWrapper';
import { Link } from 'react-router-dom';

import { OutgoingDdiRulesPatternPropertyList } from '../OutgoingDdiRulesPatternProperties';

type OutgoingDdiRulesPatternValues = OutgoingDdiRulesPatternPropertyList<
string | number | Record<string, string | number>
>;
type RuleGhostType = PropertyCustomFunctionComponent<PropertyCustomFunctionComponentProps<OutgoingDdiRulesPatternValues>>;

const Rule: RuleGhostType = (props): JSX.Element | null => {

  const { values } = props;
  const { type, prefix, matchList, matchListLink } = values;

  if (type === 'prefix') {
    return (<span>{prefix}</span>);
  }

  if (type === 'destination') {
    if (!matchListLink) {
      return null;
    }

    return (<Link to={matchListLink as string}>{matchList}</Link>);
  }

  return (<span>{matchList}</span>);
};

export default withCustomComponentWrapper<OutgoingDdiRulesPatternValues>(Rule);