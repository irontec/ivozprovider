import withCustomComponentWrapper, {
  PropertyCustomFunctionComponent,
  PropertyCustomFunctionComponentProps,
} from '@irontec-voip/ivoz-ui/services/form/Field/CustomComponentWrapper';

import { MatchListPatternPropertyList } from '../MatchListPatternProperties';

type MatchListPatternValues = MatchListPatternPropertyList<
  string | number | Record<string, string | number>
>;
type TargetGhostType = PropertyCustomFunctionComponent<
  PropertyCustomFunctionComponentProps<MatchListPatternValues>
>;

const MatchValue: TargetGhostType = (props): JSX.Element => {
  const { numberCountry, numbervalue, type, regexp } = props.values;
  const isRegex = type === 'regexp';

  if (isRegex) {
    return <span>{`${regexp}`}</span>;
  }

  return <span>{`${numberCountry}${numbervalue}`}</span>;
};

export default withCustomComponentWrapper<MatchListPatternValues>(MatchValue);
