import withCustomComponentWrapper, {
  PropertyCustomFunctionComponent,
  PropertyCustomFunctionComponentProps,
} from '@irontec/ivoz-ui/services/form/Field/CustomComponentWrapper';

import { MatchListPatternPropertyList } from '../MatchListPatternProperties';

type MatchListPatternValues = MatchListPatternPropertyList<
  string | number | Record<string, string | number>
>;
type TargetGhostType = PropertyCustomFunctionComponent<
  PropertyCustomFunctionComponentProps<MatchListPatternValues>
>;

const Target: TargetGhostType = (props): JSX.Element => {
  const { values } = props;
  const { type, numbervalue, numberCountry, regexp } = values;

  if (type === 'number') {
    return <span>{`${numberCountry} ${numbervalue}`}</span>;
  }

  return <span>{regexp as React.ReactNode}</span>;
};

export default withCustomComponentWrapper<MatchListPatternValues>(Target);
