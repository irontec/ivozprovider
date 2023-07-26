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

const MatchValue: TargetGhostType = (props): JSX.Element => {
  const { values } = props;

  const { numberCountry, numbervalue } = values;

  const value = `${numberCountry}${numbervalue}`;

  return <span>{value}</span>;
};

export default withCustomComponentWrapper<MatchListPatternValues>(MatchValue);
